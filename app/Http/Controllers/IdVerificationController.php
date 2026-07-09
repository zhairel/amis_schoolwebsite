<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IdVerificationController extends Controller
{
    /**
     * Display the ID verification page.
     */
    public function show()
    {
        $gradeLevels = [
            'Kinder 1', 'Kinder 2',
            'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6',
            'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'
        ];

        return view('pages.id-verification', compact('gradeLevels'));
    }

    /**
     * Process verification request.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'student_id'  => 'required|string',
            'full_name'   => 'required|string',
            'school_year' => 'required|string',
        ]);

        $enteredId = trim($request->input('student_id'));
        $enteredName = trim($request->input('full_name'));
        $enteredYear = trim($request->input('school_year'));

        $record = null;

        // 1. Identify ID type and search
        if (str_starts_with(strtoupper($enteredId), 'TEMP-')) {
            // Temporary Application ID
            $parts = explode('-', $enteredId);
            $applicantId = (int) end($parts);

            if ($applicantId > 0) {
                $applicant = DB::table('enrollment_applicants')->where('id', $applicantId)->first();
                if ($applicant) {
                    $record = $this->buildFromApplicant($applicant);
                }
            }
        } else {
            // AMIS Student ID
            $normalizedId = $this->normalizeAmisId($enteredId);

            // A. Search in DB Students table first (fresh data with parent contact info)
            $student = DB::table('students')
                ->leftJoin('enrollment_applicants', 'enrollment_applicants.id', '=', 'students.enrollment_applicant_id')
                ->select(
                    'students.*',
                    'enrollment_applicants.first_name',
                    'enrollment_applicants.middle_name',
                    'enrollment_applicants.last_name',
                    'enrollment_applicants.suffix',
                    'enrollment_applicants.father_first_name',
                    'enrollment_applicants.father_last_name',
                    'enrollment_applicants.mother_first_name',
                    'enrollment_applicants.mother_last_name',
                    'enrollment_applicants.photo_2x2_url',
                    'enrollment_applicants.address',
                    'enrollment_applicants.home_address',
                    'enrollment_applicants.parent_mobile',
                    'enrollment_applicants.mobile_number',
                    'enrollment_applicants.lrn',
                    'enrollment_applicants.emergency_name',
                    'enrollment_applicants.emergency_relationship',
                    'enrollment_applicants.emergency_phone'
                )
                ->where('students.student_number', $enteredId)
                ->orWhere('students.student_number', $normalizedId)
                ->first();

            if ($student) {
                $record = $this->buildFromStudent($student);
            } else {
                // B. Search in CSV (historical enrolled students fallback)
                $csvRecord = $this->searchCsv($normalizedId);
                if ($csvRecord) {
                    $record = $csvRecord;
                } else {
                    // C. Search in DB EnrollmentApplicants table
                    $applicant = DB::table('enrollment_applicants')
                        ->where('amis_student_id', $enteredId)
                        ->orWhere('amis_student_id', $normalizedId)
                        ->first();
                    
                    if ($applicant) {
                        $record = $this->buildFromApplicant($applicant);
                    }
                }
            }
        }

        // 2. Perform strict validation
        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'No matching record found. Please verify your Student ID, Full Name, and School Year.'
            ], 422);
        }

        // Validate School Year (CSV defaults to 2026-2027)
        $recordYear = $record['school_year'] ?? '2026-2027';
        if ($recordYear !== $enteredYear) {
            return response()->json([
                'success' => false,
                'message' => 'No matching record found. Please verify your Student ID, Full Name, and School Year.'
            ], 422);
        }

        // Validate Full Name
        if (!$this->nameMatches($enteredName, $record['full_name'])) {
            return response()->json([
                'success' => false,
                'message' => 'No matching record found. Please verify your Student ID, Full Name, and School Year.'
            ], 422);
        }

        // 3. Success: return details
        if (str_starts_with($record['display_id'], 'TEMP-')) {
            $qrText = 'https://amis.edu.ph/id?id=' . $record['display_id'];
        } else {
            $normalized = $this->normalizeAmisId($record['display_id']);
            $hash = base64_encode((int)$normalized + 987654);
            $qrText = 'https://amis.edu.ph/v/' . $hash;
        }
        $qrCodeUrl = route('qr.generate', ['text' => $qrText]);

        return response()->json([
            'success'     => true,
            'student_id'  => $record['display_id'],
            'full_name'   => $record['full_name'],
            'last_name'   => $record['last_name'] ?? '',
            'first_name'  => $record['first_name'] ?? '',
            'grade_level' => $record['grade_level'],
            'school_year' => $recordYear,
            'status'      => $record['status'],
            'photo_url'   => $record['photo_url'],
            'qr_code'     => $qrCodeUrl,
            'parent_name' => !blank($record['parent_name']) ? $record['parent_name'] : 'Registrar Office',
            'address'     => !blank($record['address']) ? $record['address'] : 'Davao City, Philippines',
            'contact_no'  => !blank($record['contact_no']) ? $record['contact_no'] : '+63 900 000 0000',
            'lrn'         => $record['lrn'] ?? 'N/A',
            'is_temp'     => str_starts_with($record['display_id'], 'TEMP-'),
            'is_f2f'      => $record['is_f2f'] ?? false,
        ]);
    }

    /**
     * Serve photo of temporary applicant.
     */
    public function serveTempPhoto(int $id)
    {
        $applicant = DB::table('enrollment_applicants')->where('id', $id)->first();

        if (!$applicant || !$applicant->photo_2x2_url) {
            abort(404, 'Photo not found for applicant.');
        }

        $filePath = $this->resolvePhotoPath($applicant->photo_2x2_url);

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

    /**
     * Resolve file path on local server for assets.
     */
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
     * Normalize AMIS ID format to CSV notation (e.g. AMIS-2026-000123 -> 260123).
     */
    private function normalizeAmisId(string $id): string
    {
        $id = strtoupper(trim($id));

        // Format: AMIS-YYYY-XXXXXX
        if (preg_match('/^AMIS-(\d{4})-(\d+)$/', $id, $matches)) {
            $year = substr($matches[1], 2, 2);
            $seq = (int) $matches[2];
            return $year . str_pad($seq, 4, '0', STR_PAD_LEFT);
        }

        return $id;
    }

    /**
     * Build normalized record array from EnrollmentApplicant stdClass.
     */
    private function buildFromApplicant($applicant): array
    {
        $displayId = $applicant->amis_student_id;
        $isApproved = $applicant->status === 'approved';

        if (!$displayId) {
            $year = substr($applicant->school_year ?? '2026-2027', 0, 4);
            $displayId = 'TEMP-' . $year . '-' . str_pad($applicant->id, 6, '0', STR_PAD_LEFT);
        } else {
            if (is_numeric($displayId) && strlen($displayId) >= 6) {
                $year = '20' . substr($displayId, 0, 2);
                $seq = (int) substr($displayId, 2);
                $displayId = 'AMIS-' . $year . '-' . str_pad($seq, 6, '0', STR_PAD_LEFT);
            }
        }

        // Status mapping
        $status = 'Temporary';
        if ($isApproved) {
            $status = 'Officially Enrolled';
        } elseif (in_array($applicant->status, ['pending', 'submitted', 'under_review'], true)) {
            $status = 'Pending';
        }

        // Full Name concatenation
        $fullName = trim($applicant->first_name . ' ' . ($applicant->middle_name ?? '') . ' ' . $applicant->last_name . ($applicant->suffix ? ' ' . $applicant->suffix : ''));
        
        $lastName = trim($applicant->last_name ?? '');
        $middleInitial = ($applicant->middle_name ?? '') ? mb_strtoupper(substr(trim($applicant->middle_name), 0, 1)) . '.' : '';
        $firstName = mb_strtoupper(trim($applicant->first_name ?? '')) . ($middleInitial ? ' ' . $middleInitial : '');

        // Emergency Contact & Parent Name fallback
        $parent = !empty($applicant->emergency_name) && strtolower(trim($applicant->emergency_name)) !== 'emergency contact'
            ? trim($applicant->emergency_name)
            : (trim(($applicant->father_first_name ?? '') . ' ' . ($applicant->father_last_name ?? '')) ?: (trim(($applicant->mother_first_name ?? '') . ' ' . ($applicant->mother_last_name ?? '')) ?: null));

        $contactNo = ($applicant->emergency_phone ?? null) ?: (($applicant->parent_mobile ?? null) ?: ($applicant->mobile_number ?? null));

        // Photo url using local temp route
        $photoUrl = $applicant->photo_2x2_url ? route('id-verification.temp-photo', ['id' => $applicant->id]) : null;

        return [
            'display_id'  => $displayId,
            'full_name'   => mb_strtoupper($fullName),
            'last_name'   => mb_strtoupper($lastName),
            'first_name'  => mb_strtoupper($firstName),
            'grade_level' => $applicant->grade_level,
            'school_year' => $applicant->school_year,
            'status'      => $status,
            'photo_url'   => $photoUrl,
            'qr_code_url' => null,
            'parent_name' => $parent,
            'address'     => $applicant->address ?: $applicant->home_address,
            'contact_no'  => $contactNo,
            'lrn'         => $applicant->lrn ?? 'N/A',
        ];
    }

    /**
     * Build normalized record array from Student stdClass.
     */
    private function buildFromStudent($student): array
    {
        $displayId = $student->student_number;

        if (is_numeric($displayId) && strlen($displayId) >= 6) {
            $year = '20' . substr($displayId, 0, 2);
            $seq = (int) substr($displayId, 2);
            $displayId = 'AMIS-' . $year . '-' . str_pad($seq, 6, '0', STR_PAD_LEFT);
        }

        // Full Name concatenation
        $fullName = trim($student->first_name . ' ' . ($student->middle_name ?? '') . ' ' . $student->last_name . ($student->suffix ? ' ' . $student->suffix : ''));

        $lastName = trim($student->last_name ?? '');
        $middleInitial = ($student->middle_name ?? '') ? mb_strtoupper(substr(trim($student->middle_name), 0, 1)) . '.' : '';
        $firstName = mb_strtoupper(trim($student->first_name ?? '')) . ($middleInitial ? ' ' . $middleInitial : '');

        // Emergency Contact & Parent Name fallback
        $parent = !empty($student->emergency_name) && strtolower(trim($student->emergency_name)) !== 'emergency contact'
            ? trim($student->emergency_name)
            : (trim(($student->father_first_name ?? '') . ' ' . ($student->father_last_name ?? '')) ?: (trim(($student->mother_first_name ?? '') . ' ' . ($student->mother_last_name ?? '')) ?: null));

        $contactNo = ($student->emergency_phone ?? null) ?: (($student->parent_mobile ?? null) ?: ($student->mobile_number ?? null));

        // Serve student photo using the hash route already registered in website
        $photoUrl = $student->photo_2x2_url ? route('public.student.photo', ['hash' => base64_encode((int)$student->student_number + 987654)]) : null;

        $studentNumber = $student->student_number;
        $hash = base64_encode((int)$studentNumber + 987654);
        $qrCodeUrl = 'https://quickchart.io/qr?text=' . urlencode('https://amis.edu.ph/v/' . $hash) . '&dark=000000&light=ffffff&margin=1&format=png&size=300';

        return [
            'display_id'  => $displayId,
            'full_name'   => mb_strtoupper($fullName),
            'last_name'   => mb_strtoupper($lastName),
            'first_name'  => mb_strtoupper($firstName),
            'grade_level' => $student->grade_level,
            'school_year' => $student->school_year,
            'status'      => 'Officially Enrolled',
            'photo_url'   => $photoUrl,
            'qr_code_url' => $qrCodeUrl,
            'parent_name' => $parent,
            'address'     => $student->address ?: $student->home_address,
            'contact_no'  => $contactNo,
            'lrn'         => $student->lrn ?? 'N/A',
        ];
    }

    /**
     * Search student by normalized ID in the parent-directory CSVs.
     */
    private function searchCsv(string $normalizedId): ?array
    {
        $csvPaths = [
            base_path('../AMIS_Verification_Database_Latest.csv'),
            base_path('../AMIS_F2F_Verification_Database_Latest.csv'),
        ];

        foreach ($csvPaths as $path) {
            if (!file_exists($path)) {
                continue;
            }

            if (($handle = fopen($path, 'r')) !== false) {
                $headers = fgetcsv($handle);
                if (!$headers) {
                    fclose($handle);
                    continue;
                }

                $studentIdIdx  = array_search('Student_ID', $headers);
                $fullNameIdx   = array_search('Full_Name', $headers);
                $gradeLevelIdx = array_search('Grade_Level', $headers);
                $photoUrlIdx   = array_search('Photo_URL', $headers);
                $qrUrlIdx      = array_search('QR_Code_URL', $headers);
                $parentNameIdx = array_search('Parent_Full_Name', $headers);
                $addressIdx    = array_search('Address', $headers);
                $lastNameIdx   = array_search('Last_Name', $headers);
                $contactNoIdx  = array_search('Contact_No', $headers);
                $lrnIdx        = array_search('LRN', $headers);

                if ($studentIdIdx === false || $fullNameIdx === false || $gradeLevelIdx === false) {
                    fclose($handle);
                    continue;
                }

                $isF2f = str_contains($path, 'F2F');

                while (($row = fgetcsv($handle)) !== false) {
                    if (trim($row[$studentIdIdx]) === $normalizedId) {
                        $displayId = trim($row[$studentIdIdx]);
                        if (is_numeric($displayId) && strlen($displayId) >= 6) {
                            $year = '20' . substr($displayId, 0, 2);
                            $seq = (int) substr($displayId, 2);
                            $displayId = 'AMIS-' . $year . '-' . str_pad($seq, 6, '0', STR_PAD_LEFT);
                        }

                        $fullName = trim($row[$fullNameIdx]);
                        $lastName = $lastNameIdx !== false ? trim($row[$lastNameIdx]) : '';
                        $firstName = trim(str_replace($lastName, '', $fullName));
                        $firstName = rtrim(trim($firstName), ',');

                        $res = [
                            'display_id'  => $displayId,
                            'full_name'   => mb_strtoupper($fullName),
                            'last_name'   => mb_strtoupper($lastName),
                            'first_name'  => mb_strtoupper($firstName),
                            'grade_level' => trim($row[$gradeLevelIdx]),
                            'school_year' => '2026-2027',
                            'status'      => $isF2f ? 'Under Processing' : 'Officially Enrolled',
                            'photo_url'   => $photoUrlIdx !== false ? trim($row[$photoUrlIdx]) : null,
                            'qr_code_url' => $qrUrlIdx !== false ? trim($row[$qrUrlIdx]) : null,
                            'parent_name' => $parentNameIdx !== false ? trim($row[$parentNameIdx]) : null,
                            'address'     => $addressIdx !== false ? trim($row[$addressIdx]) : null,
                            'contact_no'  => $contactNoIdx !== false ? trim($row[$contactNoIdx]) : null,
                            'lrn'         => $lrnIdx !== false ? trim($row[$lrnIdx]) : 'N/A',
                            'is_f2f'      => $isF2f,
                        ];
                        fclose($handle);
                        return $res;
                    }
                }
                fclose($handle);
            }
        }

        return null;
    }

    /**
     * Clean and normalize student names for secure, flexible comparisons.
     */
    private function cleanName(string $name): string
    {
        // Normalize Unicode characters to decompose combining marks
        if (class_exists('Normalizer')) {
            $name = \Normalizer::normalize($name, \Normalizer::FORM_D);
        }
        
        // Convert to lowercase
        $name = strtolower($name);
        
        // Replace combining tildes and standard n-tilde
        $name = str_replace(['ñ', 'ñ', 'n̈', 'Ñ', 'N̈'], 'n', $name);
        
        // Replace hyphens, commas, periods, and slashes with spaces
        $name = str_replace(['-', ',', '.', '/'], ' ', $name);
        
        // Keep only alphanumeric characters and spaces
        $name = preg_replace('/[^a-z0-9 ]/', '', $name);
        
        // Compress multiple spaces into one
        $name = preg_replace('/\s+/', ' ', $name);
        
        return trim($name);
    }

    /**
     * Compare input name and record name for security and loose verification.
     */
    private function nameMatches(string $entered, string $record): bool
    {
        $enteredClean = $this->cleanName($entered);
        $recordClean  = $this->cleanName($record);

        if ($enteredClean === $recordClean) {
            return true;
        }

        $enteredTokens = array_filter(explode(' ', $enteredClean));
        $recordTokens  = array_filter(explode(' ', $recordClean));

        if (count($enteredTokens) < 2) {
            return false;
        }

        $matchCount = 0;
        foreach ($enteredTokens as $token) {
            if (in_array($token, $recordTokens, true)) {
                $matchCount++;
            }
        }

        return $matchCount >= 2 && $matchCount >= (count($enteredTokens) - 1);
    }
}
