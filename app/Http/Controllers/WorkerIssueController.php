<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WorkerIssue;
use Illuminate\Support\Facades\Auth;

class WorkerIssueController extends Controller
{
    public function index()
    {
        $issues = WorkerIssue::where('user_id', Auth::id())->latest()->get();
        return view('worker.issues.index', compact('issues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'issue_type' => 'required|string',
            'description' => 'required|string',
        ]);

        WorkerIssue::create([
            'user_id' => Auth::id(),
            'issue_type' => $request->issue_type,
            'description' => $request->description,
        ]);

        return redirect()->route('worker.issues.index')->with('success', 'Issue reported successfully.');
    }
}
