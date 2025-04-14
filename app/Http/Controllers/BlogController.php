<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        //$posts = Blog::all();
        return view('blogs.show');
    }

    public function show($id)
    {
        $post = Blog::findOrFail($id);
        return view('blogs.show', compact('post'));
    }
}

