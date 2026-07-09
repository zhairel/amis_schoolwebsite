<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Store a feedback submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'feedback_type' => 'nullable|string|max:50',
            'rating' => 'nullable|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        Feedback::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your valuable feedback!'
        ]);
    }
}
