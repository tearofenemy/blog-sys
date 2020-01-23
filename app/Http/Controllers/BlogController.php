<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\User;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::with('author', 'tags', 'category', 'comments')->latest()->published()->search(request()->only(['query', 'month', 'year']))->simplePaginate(3);

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

    public function tag(Tag $tag)
    {
        $tagName = $tag->title;

        $posts = $tag->posts()->published()->latest()->with('author', 'category')->simplePaginate(3);

        if (view()->exists('blog.index')) {
            return view('blog.index', compact('tagName', 'posts'));
        }
    }

    public function author(User $author)
    {
        $authorName = $author->name;

        $posts = $author->posts()->published()->latest()->with('author', 'tags', 'category')->simplePaginate(3);

        if (view()->exists('blog.index')) {
            return view('blog.index', compact('posts', 'authorName'));
        }
    }

    public function show(Post $post)
    {
        //$post->increment('view_count');
        if (view()->exists('blog.show')) {
            return view('blog.show', compact('post'));
        }
    }
}