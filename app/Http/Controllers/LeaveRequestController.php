<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = Auth::user()
            ->leaveRequests()
            ->latest()
            ->get();

        return view('leave-requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        return view('leave-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
        ]);

        Auth::user()->leaveRequests()->create($validated);

        return redirect()
            ->route('leave-requests.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        abort_unless($leaveRequest->user_id === Auth::id(), 403);

        return view('leave-requests.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        abort_unless($leaveRequest->user_id === Auth::id(), 403);

        abort_unless($leaveRequest->status === 'Pending', 403);

        return view('leave-requests.edit', compact('leaveRequest'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        abort_unless($leaveRequest->user_id === Auth::id(), 403);

        abort_unless($leaveRequest->status === 'Pending', 403);

        $validated = $request->validate([
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:1000',
        ]);

        $leaveRequest->update($validated);

        return redirect()
            ->route('leave-requests.index')
            ->with('success', 'Leave request updated successfully.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        abort_unless($leaveRequest->user_id === Auth::id(), 403);

        abort_unless($leaveRequest->status === 'Pending', 403);

        $leaveRequest->delete();

        return redirect()
            ->route('leave-requests.index')
            ->with('success', 'Leave request deleted successfully.');
    }
}
