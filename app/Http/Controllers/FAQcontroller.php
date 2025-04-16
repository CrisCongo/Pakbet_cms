<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FAQcontroller extends Controller
{
    public function index()
    {
        return view('FAQs.showFAQs');//temporary
    }
    public function edit()
    {
        return view('FAQs.editFAQs');
    }
    public function add()
    {
        return view('FAQs.addFAQs');
    }
}
