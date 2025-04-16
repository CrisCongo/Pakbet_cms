<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        return view('prosperGuide.showGuide');//temporary
    }
    public function edit()
    {
        return view('prosperGuide.editGuide');
    }
    public function add()
    {
        return view('prosperGuide.addGuide');
    }
}
