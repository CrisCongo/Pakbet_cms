<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'publish_date' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
        ]);

        Faq::create($validated);

        return redirect()->route('faqs.index')->with('success', 'FAQ added successfully!');
    }
}
