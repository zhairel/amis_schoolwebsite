<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$records = [];

// 1. Fetch Verified Students (Enrolled students from students table joined with applicants)
$verifiedStudents = DB::table('students')
    ->leftJoin('enrollment_applicants', 'students.enrollment_applicant_id', '=', 'enrollment_applicants.id')
    ->select(
        'students.student_number',
        'students.grade_level as student_grade',
        'students.school_year as student_sy',
        'enrollment_applicants.*'
    )
    ->where('enrollment_applicants.learning_mode', 'Face-to-Face')
    ->get();

foreach ($verifiedStudents as $student) {
    $displayId = $student->student_number;
    if (is_numeric($displayId) && strlen($displayId) >= 6) {
        $year = '20' . substr($displayId, 0, 2);
        $seq = (int) substr($displayId, 2);
        $displayId = 'AMIS-' . $year . '-' . str_pad($seq, 6, '0', STR_PAD_LEFT);
    }
    
    // Evaluate fields
    $hasPhoto = !empty($student->photo_2x2_url) && !str_contains($student->photo_2x2_url, 'default-avatar');
    $photoStatus = $hasPhoto ? '✓' : '✗';

    $father = trim(($student->father_first_name ?? '') . ' ' . ($student->father_last_name ?? ''));
    $mother = trim(($student->mother_first_name ?? '') . ' ' . ($student->mother_last_name ?? ''));
    $parent = $father ?: ($mother ?: null);
    if (!$parent && !empty($student->emergency_name) && strtolower(trim($student->emergency_name)) !== 'emergency contact') {
        $parent = trim($student->emergency_name);
    }
    $hasParent = !empty($parent) && strtoupper($parent) !== 'REGISTRAR OFFICE';
    $parentStatus = $hasParent ? '✓' : '✗';

    $address = trim($student->address ?: ($student->home_address ?? ''));
    $hasAddress = !empty($address) && strtoupper($address) !== 'DAVAO CITY, PHILIPPINES';
    $addressStatus = $hasAddress ? '✓' : '✗';

    $contactNo = ($student->parent_mobile ?? null) ?: (($student->mobile_number ?? null) ?: ($student->emergency_phone ?? null));
    $hasContact = !empty($contactNo) && $contactNo !== '+63 900 000 0000';
    $contactStatus = $hasContact ? '✓' : '✗';

    $lrn = trim($student->lrn ?? '');
    if (empty($lrn) || strtoupper($lrn) === 'N/A' || strtoupper($lrn) === 'NA') {
        $lrnStatus = '✗';
        $lrnText = 'MISSING';
    } else {
        $lrnStatus = '✓';
        $lrnText = $lrn;
    }

    $isComplete = $hasPhoto && $hasParent && $hasAddress && $hasContact;
    $overallStatus = $isComplete ? '✓ COMPLETE' : '✗ INCOMPLETE';

    $records[] = [
        'display_id' => $displayId,
        'id_type' => 'Verified',
        'last_name' => $student->last_name,
        'first_name' => $student->first_name,
        'middle_name' => $student->middle_name ?? '',
        'suffix' => $student->suffix ?? '',
        'grade_level' => $student->student_grade ?: $student->grade_level,
        'lrn_text' => $lrnText,
        'lrn_status' => $lrnStatus,
        'status' => 'Officially Enrolled',
        'photo_url' => $student->photo_2x2_url ?? '',
        'photo_status' => $photoStatus,
        'parent_name' => $parent ?: '',
        'parent_status' => $parentStatus,
        'address' => $address,
        'address_status' => $addressStatus,
        'contact_no' => $contactNo ?? '',
        'contact_status' => $contactStatus,
        'overall_status' => $overallStatus
    ];
}

// 2. Fetch Temporary Students (Applicants in Face-to-Face learning mode who do not have a record in students table)
$enrolledApplicantIds = DB::table('students')->whereNotNull('enrollment_applicant_id')->pluck('enrollment_applicant_id')->toArray();

$temporaryApplicants = DB::table('enrollment_applicants')
    ->where('learning_mode', 'Face-to-Face')
    ->whereNotIn('id', $enrolledApplicantIds)
    ->get();

foreach ($temporaryApplicants as $student) {
    $year = substr($student->school_year ?? '2026-2027', 0, 4);
    $displayId = 'TEMP-' . $year . '-' . str_pad($student->id, 6, '0', STR_PAD_LEFT);
    
    // Evaluate fields
    $hasPhoto = !empty($student->photo_2x2_url) && !str_contains($student->photo_2x2_url, 'default-avatar');
    $photoStatus = $hasPhoto ? '✓' : '✗';

    $father = trim(($student->father_first_name ?? '') . ' ' . ($student->father_last_name ?? ''));
    $mother = trim(($student->mother_first_name ?? '') . ' ' . ($student->mother_last_name ?? ''));
    $parent = $father ?: ($mother ?: null);
    if (!$parent && !empty($student->emergency_name) && strtolower(trim($student->emergency_name)) !== 'emergency contact') {
        $parent = trim($student->emergency_name);
    }
    $hasParent = !empty($parent) && strtoupper($parent) !== 'REGISTRAR OFFICE';
    $parentStatus = $hasParent ? '✓' : '✗';

    $address = trim($student->address ?: ($student->home_address ?? ''));
    $hasAddress = !empty($address) && strtoupper($address) !== 'DAVAO CITY, PHILIPPINES';
    $addressStatus = $hasAddress ? '✓' : '✗';

    $contactNo = ($student->parent_mobile ?? null) ?: (($student->mobile_number ?? null) ?: ($student->emergency_phone ?? null));
    $hasContact = !empty($contactNo) && $contactNo !== '+63 900 000 0000';
    $contactStatus = $hasContact ? '✓' : '✗';

    $lrn = trim($student->lrn ?? '');
    if (empty($lrn) || strtoupper($lrn) === 'N/A' || strtoupper($lrn) === 'NA') {
        $lrnStatus = '✗';
        $lrnText = 'MISSING';
    } else {
        $lrnStatus = '✓';
        $lrnText = $lrn;
    }

    $isComplete = $hasPhoto && $hasParent && $hasAddress && $hasContact;
    $overallStatus = $isComplete ? '✓ COMPLETE' : '✗ INCOMPLETE';

    $records[] = [
        'display_id' => $displayId,
        'id_type' => 'Temporary',
        'last_name' => $student->last_name,
        'first_name' => $student->first_name,
        'middle_name' => $student->middle_name ?? '',
        'suffix' => $student->suffix ?? '',
        'grade_level' => $student->grade_level,
        'lrn_text' => $lrnText,
        'lrn_status' => $lrnStatus,
        'status' => ucfirst($student->status),
        'photo_url' => $student->photo_2x2_url ?? '',
        'photo_status' => $photoStatus,
        'parent_name' => $parent ?: '',
        'parent_status' => $parentStatus,
        'address' => $address,
        'address_status' => $addressStatus,
        'contact_no' => $contactNo ?? '',
        'contact_status' => $contactStatus,
        'overall_status' => $overallStatus
    ];
}

// 3. Sort Records
$gradeOrder = [
    'Kinder 1' => 1, 'Kinder 2' => 2,
    'Grade 1' => 3, 'Grade 2' => 4, 'Grade 3' => 5, 'Grade 4' => 6, 'Grade 5' => 7, 'Grade 6' => 8,
    'Grade 7' => 9, 'Grade 8' => 10, 'Grade 9' => 11, 'Grade 10' => 12, 'Grade 11' => 13, 'Grade 12' => 14
];

usort($records, function($a, $b) use ($gradeOrder) {
    // 1. Sort by ID Type (Verified first)
    if ($a['id_type'] !== $b['id_type']) {
        return $a['id_type'] === 'Verified' ? -1 : 1;
    }
    
    // 2. Sort by Grade Level
    $gradeA = $gradeOrder[$a['grade_level']] ?? 99;
    $gradeB = $gradeOrder[$b['grade_level']] ?? 99;
    if ($gradeA !== $gradeB) {
        return $gradeA - $gradeB;
    }
    
    // 3. Sort by Name
    $cmp = strcmp($a['last_name'], $b['last_name']);
    if ($cmp !== 0) return $cmp;
    
    return strcmp($a['first_name'], $b['first_name']);
});

// Open output stream
$out = fopen('php://stdout', 'w');

// Headers
fputcsv($out, [
    'Student ID',
    'ID Type',
    'Last Name',
    'First Name',
    'Middle Name',
    'Suffix',
    'Grade Level',
    'LRN Number',
    'LRN Status',
    'Enrollment Status',
    'Photo URL',
    'Photo?',
    'Parent Guardian Name',
    'Parent?',
    'Address',
    'Address?',
    'Contact Number',
    'Contact?',
    'Overall Status'
]);

foreach ($records as $r) {
    fputcsv($out, [
        $r['display_id'],
        $r['id_type'],
        $r['last_name'],
        $r['first_name'],
        $r['middle_name'],
        $r['suffix'],
        $r['grade_level'],
        $r['lrn_text'],
        $r['lrn_status'],
        $r['status'],
        $r['photo_url'],
        $r['photo_status'],
        $r['parent_name'],
        $r['parent_status'],
        $r['address'],
        $r['address_status'],
        $r['contact_no'],
        $r['contact_status'],
        $r['overall_status']
    ]);
}

fclose($out);
