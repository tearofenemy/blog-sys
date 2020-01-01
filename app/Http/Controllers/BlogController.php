<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::with('author')->latest()->published()->simplePaginate(3);

        if (view()->exists('blog.index')) {
            return view('blog.index', compact('posts'));
        }
    }

    public function category(Category $category)
    {

        $categoryName = $category->title;

        $posts = $category->posts()->published()->latest()->with('author')->simplePaginate(3);

        if (view()->exists('blog.index')) {
            return view('blog.index', compact('posts', 'categoryName'));
        }
    }

    public function author(User $author)
    {
        $authorName = $author->name;

        $posts = $author->posts()->published()->latest()->with('author')->simplePaginate(3);

        if (view()->exists('blog.index')) {
            return view('blog.index', compact('posts', 'authorName'));
        }
    }

    public function show(Post $post)
    {
        $post->increment('view_count');
        if (view()->exists('blog.show')) {
            return view('blog.show', compact('post'));
        }
    }
}