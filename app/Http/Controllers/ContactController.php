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
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:50',
                'address' => 'required|string',
                'ms_teams' => 'required|string|max:255',
                'level' => 'required|string|max:255',
                'grade_level' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            \App\Models\HalaqahRegistration::create($validated);

            // Auto-send notification email to agonzales.amis@gmail.com
            try {
                $emailBody = "New Halaqah Online Registration received:\n\n"
                    . "Name: " . $validated['name'] . "\n"
                    . "Email: " . $validated['email'] . "\n"
                    . "Phone: " . $validated['phone'] . "\n"
                    . "Address: " . $validated['address'] . "\n"
                    . "MS Teams Account: " . $validated['ms_teams'] . "\n"
                    . "Grade Level: " . $validated['grade_level'] . "\n"
                    . "Learning Level: " . $validated['level'] . "\n\n"
                    . "Message/Goals:\n" . $validated['message'];

                \Illuminate\Support\Facades\Mail::raw($emailBody, function ($message) use ($validated) {
                    $message->to('agonzales.amis@gmail.com')
                            ->subject('AMIS Halaqah Registration: ' . $validated['name'])
                            ->replyTo($validated['email'], $validated['name']);
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
