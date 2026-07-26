<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SitemapController;

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\n\nSitemap: https://amis.edu.ph/sitemap.xml\n";
    return response($content, 200)->header('Content-Type', 'text/plain');
})->name('robots');


// Public Pages Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/news', [PageController::class, 'newsIndex'])->name('news.index');
Route::get('/events', [PageController::class, 'eventsIndex'])->name('events.index');
Route::get('/announcement/{id}', [PageController::class, 'announcementShow'])->name('announcement.show');

Route::prefix('about')->name('about.')->group(function () {
    Route::get('/', [PageController::class, 'about'])->name('index');
    Route::get('/history', [PageController::class, 'history'])->name('history');
    Route::get('/philosophy-vision-mission-goals', [PageController::class, 'philosophy'])->name('philosophy');
    Route::get('/school-logo', [PageController::class, 'logo'])->name('logo');
    Route::get('/why-islamic-school', [PageController::class, 'why'])->name('why');
    Route::get('/certifications', [PageController::class, 'certifications'])->name('certifications');
    Route::get('/location', [PageController::class, 'location'])->name('location');
});

Route::prefix('academics')->name('academics.')->group(function () {
    Route::get('/', [PageController::class, 'academics'])->name('index');
    Route::get('/basic-education', [PageController::class, 'basicEducation'])->name('basic-education');
    Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar');
});

Route::get('/calendar', [PageController::class, 'calendar'])->name('calendar.short');

Route::prefix('isal')->name('isal.')->group(function () {
    Route::get('/halaqah', [PageController::class, 'halaqah'])->name('halaqah');
    Route::get('/halaqah-parents', [PageController::class, 'halaqahParents'])->name('halaqah-parents');
});

Route::redirect('/academics/halaqah-online', '/isal/halaqah', 301);

Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// POST requests
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Student ID verification portal
use App\Http\Controllers\PublicVerificationController;
Route::get('/verify/student/{student_number}', [PublicVerificationController::class, 'verifyStudent'])->name('public.student.verify');
Route::get('/v/{student_number}', [PublicVerificationController::class, 'verifyStudent'])->name('public.student.verify.short');
Route::get('/student-photo/{hash}.jpg', [PublicVerificationController::class, 'servePhoto'])->name('public.student.photo');
Route::get('/qr-code', [PublicVerificationController::class, 'generateQr'])->name('qr.generate');

// Project Roadmap Portal
Route::get('/roadmap', function () {
    return view('pages.roadmap');
})->name('public.roadmap');

// Internal tester for the Authorized AMIS Holographic Signature Seal.
Route::view('/authorized', 'pages.authorized-seal')->name('authorized-seal.tester');

// Secure signature verification coming soon portal
Route::view('/signature', 'pages.signature-coming-soon')->name('public.signature-coming-soon');

// ID Verification portal — DISABLED
// Route::get('/id', [IdVerificationController::class, 'show'])->name('id-verification.show');
// Route::post('/id', [IdVerificationController::class, 'verify'])->name('id-verification.verify');
// Route::get('/id-photo/temp/{id}', [IdVerificationController::class, 'serveTempPhoto'])->name('id-verification.temp-photo');
// Route::redirect('/id-verification', '/id');
Route::get('/id', function () { abort(404); });
Route::get('/id-verification', function () { abort(404); });


