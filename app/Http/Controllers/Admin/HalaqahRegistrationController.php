<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HalaqahRegistration;
use Illuminate\Http\Request;

class HalaqahRegistrationController extends Controller
{
    /**
     * Display a listing of Halaqah registrations.
     */
    public function index(Request $request)
    {
        $query = HalaqahRegistration::query()->orderBy('created_at', 'desc');

        // Search Filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('fb_account', 'like', "%{$search}%")
                  ->orWhere('ms_teams', 'like', "%{$search}%");
            });
        }

        // Program Type Filter
        $type = $request->input('type');
        if ($type === 'online') {
            $query->where(function ($q) {
                $q->where('type', 'like', '%Online%')
                  ->orWhere('grade_level', 'like', '%Online%');
            });
        } elseif ($type === 'parents') {
            $query->where(function ($q) {
                $q->where('type', 'like', '%Parents%')
                  ->orWhere('grade_level', 'like', '%Parents%');
            });
        }

        // Statistics
        $totalCount = HalaqahRegistration::count();
        $onlineCount = HalaqahRegistration::where(function ($q) {
            $q->where('type', 'like', '%Online%')->orWhere('grade_level', 'like', '%Online%');
        })->count();
        $parentsCount = HalaqahRegistration::where(function ($q) {
            $q->where('type', 'like', '%Parents%')->orWhere('grade_level', 'like', '%Parents%');
        })->count();
        $beginnerCount = HalaqahRegistration::where('level', 'like', '%BEGINNER%')->count();
        $advanceCount = HalaqahRegistration::where('level', 'like', '%ADVANCE%')->count();

        $registrations = $query->paginate(20)->withQueryString();

        return view('admin.halaqah_registrations.index', compact(
            'registrations',
            'totalCount',
            'onlineCount',
            'parentsCount',
            'beginnerCount',
            'advanceCount',
            'search',
            'type'
        ));
    }

    /**
     * Remove the specified registration.
     */
    public function destroy($id)
    {
        $registration = HalaqahRegistration::findOrFail($id);
        $registration->delete();

        return back()->with('success', 'Registration record deleted successfully.');
    }

    /**
     * Export registrations as CSV.
     */
    public function exportCsv()
    {
        $registrations = HalaqahRegistration::orderBy('created_at', 'desc')->get();

        $filename = "halaqah_registrations_" . date('Y-m-d_His') . ".csv";

        $headers = [
            "Content-type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$filename}",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Column Headers
            fputcsv($file, [
                'ID',
                'Registration Date',
                'Program Type',
                'Full Name',
                'Age',
                'Sex',
                'Civil Status',
                'Learning Level',
                'FB Account Link',
                'Mobile Number',
                'Email Address'
            ]);

            foreach ($registrations as $reg) {
                fputcsv($file, [
                    $reg->id,
                    $reg->created_at ? $reg->created_at->format('Y-m-d H:i:s') : '',
                    $reg->type ?: ($reg->grade_level ?: 'Halaqah Registration'),
                    $reg->name,
                    $reg->age ?: 'N/A',
                    $reg->sex ?: 'N/A',
                    $reg->status ?: 'N/A',
                    $reg->level ?: 'N/A',
                    $reg->fb_account ?: ($reg->ms_teams ?: 'N/A'),
                    $reg->mobile ?: ($reg->phone ?: 'N/A'),
                    $reg->email ?: 'N/A',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
