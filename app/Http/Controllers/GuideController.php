<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProsperGuide;
use Carbon\Carbon;

class GuideController extends Controller
{
    public function index()
    {
        $guides = ProsperGuide::all();
        return view('prosperGuide.showGuide', compact('guides'));
    }

    public function edit($zodiacID)
    {
        $guide = ProsperGuide::where('zodiacID', $zodiacID)->first();

        if (!$guide) {
            return redirect()->route('guide.index')->with('error', 'Guide not found');
        }

        if (empty($guide->publish_date)) {
            $guide->publish_date = Carbon::today();
        } else {
            $guide->publish_date = Carbon::parse($guide->publish_date);
        }

        return view('prosperGuide.editGuide', compact('guide'));
    }

    public function update(Request $request, $zodiacID)
    {
        $request->validate([
            'publish_date' => 'nullable|date',
            'overview' => 'required',
            'career' => 'required',
            'health' => 'required',
            'love' => 'required',
            'wealth' => 'required',
            'status' => 'required|in:draft,published,archive',
        ]);

        $guide = ProsperGuide::where('zodiacID', $zodiacID)->first();
        $guide->publish_date = $request->input('publish_date') ?: Carbon::today();

        if (!$guide) {
            return redirect()->route('guide.index')->with('error', 'Guide not found');
        }

        $guide->update([
            'publish_date' => $request->publish_date,
            'overview' => $request->overview,
            'career' => $request->career,
            'health' => $request->health,
            'love' => $request->love,
            'wealth' => $request->wealth,
            'status' => $request->status,
        ]);

        return redirect()->route('guide.index')->with('success', 'Guide updated successfully');
    }

    public function bulkUpdate(Request $request)
    {
        $action = $request->input('action');
        $guides = $request->input('guides');

        foreach ($guides as $guideId) {
            $guide = ProsperGuide::find($guideId);
            if ($action === 'publish') {
                $guide->status = 'published';
            } elseif ($action === 'archive') {
                $guide->status = 'archived';
            }
            $guide->save();
        }

        return response()->json(['success' => true]);
    }
}

