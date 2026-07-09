<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicVerificationController extends Controller
{
    public function verifyStudent(string $studentNumberOrHash)
    {
        $studentNumber = $studentNumberOrHash;
        if (!is_numeric($studentNumberOrHash)) {
            $decoded = base64_decode($studentNumberOrHash);
            if (is_numeric($decoded)) {
                $studentNumber = (string)((int)$decoded - 987654);
            }
        }

        $student = DB::table('students')
            ->leftJoin('enrollment_applicants', 'enrollment_applicants.id', '=', 'students.enrollment_applicant_id')
            ->leftJoin('users', 'users.id', '=', 'students.user_id')
            ->select(
                'students.student_number',
                'students.grade_level',
                'students.school_year',
                'enrollment_applicants.first_name',
                'enrollment_applicants.middle_name',
                'enrollment_applicants.last_name',
                'enrollment_applicants.learning_mode',
                'users.account_status'
            )
            ->where(function ($query) use ($studentNumber) {
                $query->where('students.student_number', $studentNumber);
                if (is_numeric($studentNumber) && strlen($studentNumber) < 6) {
                    $padded = str_pad($studentNumber, 4, '0', STR_PAD_LEFT);
                    $query->orWhere('students.student_number', 'like', '%' . $padded);
                }
            })
            ->first();

        return view('public.verify_student', [
            'student' => $student,
            'studentNumber' => $student ? $student->student_number : $studentNumber,
        ]);
    }

    public function servePhoto(string $hash)
    {
        $studentNumber = $hash;
        if (!is_numeric($hash)) {
            $decoded = base64_decode($hash);
            if (is_numeric($decoded)) {
                $studentNumber = (string)((int)$decoded - 987654);
            }
        }

        $student = DB::table('students')
            ->leftJoin('enrollment_applicants', 'enrollment_applicants.id', '=', 'students.enrollment_applicant_id')
            ->select('enrollment_applicants.photo_2x2_url')
            ->where(function ($query) use ($studentNumber) {
                $query->where('students.student_number', $studentNumber);
                if (is_numeric($studentNumber) && strlen($studentNumber) < 6) {
                    $padded = str_pad($studentNumber, 4, '0', STR_PAD_LEFT);
                    $query->orWhere('students.student_number', 'like', '%' . $padded);
                }
            })
            ->first();

        if (!$student || !$student->photo_2x2_url) {
            abort(404, 'Photo not found for student.');
        }

        $filePath = $this->resolvePhotoPath($student->photo_2x2_url);

        if (!$filePath || !file_exists($filePath)) {
            abort(404, 'File not found on server.');
        }

        $mime = mime_content_type($filePath);
        return response()->file($filePath, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=86400',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        ]);
    }

    private function resolvePhotoPath($path)
    {
        if (blank($path)) {
            return null;
        }

        $path = ltrim((string) $path, '/');

        $roots = [
            base_path('../admin.amis.edu.ph/public/storage'),
            base_path('../admin.amis.edu.ph/storage/app/public'),
            base_path('../amis_enrollment/storage/app/public'),
            base_path('../amis_enrollment/public/storage'),
            base_path('../enrollment/storage/app/public'),
            base_path('../enrollment/public/storage'),
            storage_path('app/public'),
            public_path('storage'),
            public_path(),
        ];

        $candidates = [];

        if (str_contains($path, 'optimized/')) {
            $originalDirectory = dirname(str_replace('optimized/', 'original/', $path));
            $filename = pathinfo($path, PATHINFO_FILENAME);

            foreach ($roots as $root) {
                $directory = rtrim($root, '/').'/'.$originalDirectory;
                if (is_dir($directory)) {
                    foreach (glob($directory.'/'.$filename.'.*') ?: [] as $file) {
                        $candidates[] = $file;
                    }
                }
            }
            $candidates[] = str_replace('optimized/', 'thumbnails/large/', $path);
            $candidates[] = str_replace('optimized/', 'thumbnails/medium/', $path);
        }

        $candidates[] = $path;

        foreach ($candidates as $candidate) {
            if (file_exists($candidate) && is_file($candidate) && filesize($candidate) > 0) {
                return $candidate;
            }
            foreach ($roots as $root) {
                $absolute = rtrim($root, '/').'/'.ltrim($candidate, '/');
                if (file_exists($absolute) && is_file($absolute) && filesize($absolute) > 0) {
                    return $absolute;
                }
            }
        }

        return null;
    }

    /**
     * Generate QR Code securely proxied to prevent CORS canvas taint issues.
     */
    public function generateQr(\Illuminate\Http\Request $request)
    {
        $text = $request->query('text', '');
        
        $url = 'https://quickchart.io/qr?text=' . urlencode($text) . '&dark=000000&light=ffffff&margin=1&format=png&size=300';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $data = curl_exec($ch);
        curl_close($ch);
        
        if (!$data) {
            abort(404, 'Failed to generate QR code.');
        }
        
        return response($data, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=604800',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        ]);
    }
}

