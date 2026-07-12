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
        // If this is a Halaqah registration, save to HalaqahRegistration model
        if ($request->input('subject') === 'Halaqah Online Registration') {
            $request->validate([
                'first_name' => 'required|string|max:100',
                'middle_name' => 'nullable|string|max:100',
                'last_name' => 'required|string|max:100',
            ]);

            $firstName = trim((string) $request->input('first_name'));
            $middleName = trim((string) $request->input('middle_name'));
            $lastName = trim((string) $request->input('last_name'));

            $fullName = $firstName;
            if ($middleName !== '') {
                $fullName .= ' ' . $middleName;
            }
            if ($lastName !== '') {
                $fullName .= ' ' . $lastName;
            }
            $fullName = trim($fullName);

            $request->merge(['name' => $fullName]);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:50',
                'address' => 'nullable|string',
                'ms_teams' => 'nullable|string|max:255',
                'level' => 'nullable|string|max:255',
                'grade_level' => 'required|string|max:255',
                'message' => 'nullable|string',
            ]);

            // Fill optional fields with empty strings to satisfy database constraints
            $validated['email'] = $validated['email'] ?? '';
            $validated['phone'] = $validated['phone'] ?? '';
            $validated['address'] = $validated['address'] ?? '';
            $validated['ms_teams'] = $validated['ms_teams'] ?? '';
            $validated['level'] = $validated['level'] ?? '';
            $validated['message'] = $validated['message'] ?? '';

            \App\Models\HalaqahRegistration::create($validated);

            // Auto-send notification email to agonzales.amis@gmail.com
            try {
                $emailBody = "New Halaqah Online Registration received:\n\n"
                    . "Name: " . $validated['name'] . "\n"
                    . "Email: " . ($validated['email'] ?: 'N/A') . "\n"
                    . "Phone: " . ($validated['phone'] ?: 'N/A') . "\n"
                    . "Address: " . ($validated['address'] ?: 'N/A') . "\n"
                    . "MS Teams Account: " . ($validated['ms_teams'] ?: 'N/A') . "\n"
                    . "Grade Level: " . $validated['grade_level'] . "\n"
                    . "Learning Level: " . ($validated['level'] ?: 'N/A') . "\n\n"
                    . "Message/Goals:\n" . ($validated['message'] ?: 'N/A');

                \Illuminate\Support\Facades\Mail::raw($emailBody, function ($message) use ($validated) {
                    $message->to('agonzales.amis@gmail.com')
                            ->subject('AMIS Halaqah Registration: ' . $validated['name']);
                    if (!empty($validated['email'])) {
                        $message->replyTo($validated['email'], $validated['name']);
                    }
                });
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Halaqah registration email failed: ' . $e->getMessage());
            }

            return back()->with('success', 'Thank you! Your registration has been submitted successfully.');
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
