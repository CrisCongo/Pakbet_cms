<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FAQcontroller extends Controller
{
    public function index()
    {
        $faqs = Faq::paginate(10);
        return view('FAQs.showFAQs', compact('faqs'));
    }
    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'faqs' => 'required|array',
            'action' => 'required|in:activate,deactivate',
        ]);

        $faqs = Faq::whereIn('faqID', $validated['faqs']);

        if ($validated['action'] == 'activate') {
            $faqs->update(['status' => 'published']);
            return redirect()->route('faqs.index')->with('success', 'Selected FAQs have been published!');
        } elseif ($validated['action'] == 'deactivate') {
            $faqs->update(['status' => 'archived']);
            return redirect()->route('faqs.index')->with('success', 'Selected FAQs have been archived!');
        }

        return redirect()->route('faqs.index')->with('error', 'Invalid action!');
    }
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('FAQs.editFAQs', compact('faq'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'publish_date' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($validated);

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully!');
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
