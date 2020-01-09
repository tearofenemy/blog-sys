<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Intervention\Image\Facades\Image;

class BlogController extends BackendController
{

    protected $limit = 5;
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path(config('cms.img.directory'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed = false;
        if (($status = $request->get('status')) && $status == 'trash') {
            $posts = Post::onlyTrashed()->with('category', 'author')->latest()->paginate($this->limit);
            $postsCount = Post::onlyTrashed()->count();
            $onlyTrashed = true;
        } elseif ($status == 'published') {
            $posts = Post::published()->with('category', 'author')->latest()->paginate($this->limit);
            $postsCount = Post::published()->count();
        } elseif ($status == 'sheduled') {
            $posts = Post::sheduled()->with('category', 'author')->latest()->paginate($this->limit);
            $postsCount = Post::sheduled()->count();
        } elseif ($status == 'draft') {
            $posts = Post::draft()->with('category', 'author')->latest()->paginate($this->limit);
            $postsCount = Post::draft()->count();
        } else {
            $posts = Post::with('category', 'author')->latest()->paginate($this->limit);
            $postsCount = Post::count();
        }

        $statusList = $this->statusList();

        if (view()->exists('backend.blog.index')) {
            return view('backend.blog.index', compact('posts', 'postsCount', 'onlyTrashed', 'statusList'));
        }
    }

    private function statusList()
    {
        return [
            'all' => Post::count(),
            'published' => Post::published()->count(),
            'sheduled' => Post::sheduled()->count(),
            'draft' => Post::draft()->count(),
            'trash' => Post::onlyTrashed()->count()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        if (view()->exists('backend.blog.create')) {
            return view('backend.blog.create', compact('post'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $this->handleRequest($request);

        $request->user()->posts()->create($data);
        return redirect('/backend/blog')->with('message', 'Your post was successfully created.');
    }

    private function removeImg($img)
    {
        if (!empty($img)) {
            $imgPath = $this->uploadPath . "/" . $img;
            $ext = substr(strchr($img, "."),  1);
            $thumb = str_replace(".{$ext}", "_thumb.{$ext}", $img);
            $thumbPath = $this->uploadPath . "/" . $thumb;
            if (file_exists($imgPath)) unlink($imgPath);
            if (file_exists($thumbPath)) unlink($thumbPath);
        }
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('img')) {

            $img = $request->file('img');
            $fileName = $img->getClientOriginalName();
            $destination = $this->uploadPath;

            $successUploaded = $img->move($destination, $fileName);

            if ($successUploaded) {

                $width = config("cms.img.thumbnail.width");
                $height = config("cms.img.thumbnail.height");
                $extension = $img->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                Image::make($destination . "/" . $fileName)->resize($width, $height)->save($destination . "/" . $thumbnail);
            }

            $data['img'] = $fileName;
        }
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::findOrFail($id);
        if (view()->exists('backend.blog.edit')) {
            return view('backend.blog.edit', compact('post'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $data = $this->handleRequest($request);
        $post->update($data);
        return redirect('/backend/blog')->with('message', "Your post was successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect('/backend/blog')->with('trash-msg', ["Your post successufully moved to Trash.", $id]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect('/backend/blog')->with('message', 'Your post was successfully restored from Trash.');
    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        $this->removeImg($post->img);
        return redirect('/backend/blog?status=trash')->with('message', 'Your post have been successfully deleted');
    }
}