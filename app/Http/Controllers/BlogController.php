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
        return view('blogs.show');//temporary
    }
    public function edit()
    {
        return view('blogs.editBlog');//temporary
    }
    public function add(){
        return view('blogs.addBlog');
    }
}

