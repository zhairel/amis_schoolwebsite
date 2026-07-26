<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a contact form submission.
     */
    public function store(Request $request)
    {
        // Handle Halaqah Online & Halaqah Parents registrations
        if (in_array($request->input('subject'), ['Halaqah Online Registration', 'Halaqah Parents Registration'])) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|numeric|min:1|max:120',
                'sex' => 'required|string|max:20',
                'status' => 'required|string|max:50',
                'level' => 'required|string|max:50',
                'fb_account' => 'required|string|max:255',
                'mobile' => 'required|string|max:50',
                'email' => 'required|email|max:255',
            ]);

            $subjectTitle = $request->input('subject');
            $fullName = mb_strtoupper(trim($validated['name']), 'UTF-8');

            // Construct formatted message
            $messageData = "Registration Type: {$subjectTitle}\n"
                . "Name: {$fullName}\n"
                . "Age: {$validated['age']}\n"
                . "Sex: {$validated['sex']}\n"
                . "Civil Status: {$validated['status']}\n"
                . "Learning Level: {$validated['level']}\n"
                . "FB Account Link: {$validated['fb_account']}\n"
                . "Mobile Number: {$validated['mobile']}\n"
                . "Email: {$validated['email']}\n";

            try {
                \App\Models\HalaqahRegistration::create([
                    'name' => $fullName,
                    'age' => (int) $validated['age'],
                    'sex' => $validated['sex'],
                    'status' => $validated['status'],
                    'level' => $validated['level'],
                    'fb_account' => $validated['fb_account'],
                    'mobile' => $validated['mobile'],
                    'email' => $validated['email'],
                    'type' => $subjectTitle,
                    'phone' => $validated['mobile'],
                    'address' => "Age: {$validated['age']} | Sex: {$validated['sex']} | Status: {$validated['status']}",
                    'ms_teams' => $validated['fb_account'],
                    'grade_level' => $subjectTitle,
                    'message' => $messageData,
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Halaqah registration save failed: ' . $e->getMessage());
            }

            // Send notification email to agonzales.amis@gmail.com
            try {
                \Illuminate\Support\Facades\Mail::raw("New {$subjectTitle}:\n\n" . $messageData, function ($message) use ($fullName, $subjectTitle, $validated) {
                    $message->to('agonzales.amis@gmail.com')
                            ->subject("{$subjectTitle}: {$fullName}");
                    if (!empty($validated['email'])) {
                        $message->replyTo($validated['email'], $fullName);
                    }
                });
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Halaqah registration email failed: ' . $e->getMessage());
            }

            return back()->with('success', 'JazakAllahu Khayran! Thank you for registering. Your details have been received successfully.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactSubmission::create($validated);

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
