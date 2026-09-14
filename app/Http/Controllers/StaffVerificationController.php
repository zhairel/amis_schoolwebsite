<?php

namespace App\Http\Controllers;

use App\Models\StaffVerification;
use App\Services\StaffQrCodeService;
use App\Services\StaffCallingCardService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\Response;

class StaffVerificationController extends Controller
{
    protected StaffQrCodeService $qrService;
    protected StaffCallingCardService $callingCardService;

    public function __construct(
        StaffQrCodeService $qrService,
        StaffCallingCardService $callingCardService
    ) {
        $this->qrService = $qrService;
        $this->callingCardService = $callingCardService;
    }

    /**
     * Display the official verification page for a staff member with SVG Calling Card.
     */
    public function show(string $slug): View|Response
    {
        $staff = StaffVerification::where('slug', $slug)->first();

        if (!$staff || !$staff->isActive()) {
            return response()->view('staff.failed', [
                'slug' => $slug,
                'searchedStaff' => $staff,
            ], 404);
        }

        $verificationUrl = $staff->verification_url;
        $qrSvg = $this->qrService->generateSvg($verificationUrl, false, '#022c22');
        $qrSvgTransparent = $this->qrService->generateSvg($verificationUrl, true, '#022c22');
        $qrDataUri = $this->qrService->generateDataUri($verificationUrl, false, '#022c22');

        // Pure SVG Calling Cards
        $cardSvg = $this->callingCardService->generateCardSvg($staff, false);
        $cardQrSvg = $this->callingCardService->generateCardSvg($staff, true);
        $cardBackSvg = $this->callingCardService->generateCardBackSvg($staff);

        return view('staff.verify', compact(
            'staff',
            'verificationUrl',
            'qrSvg',
            'qrSvgTransparent',
            'qrDataUri',
            'cardSvg',
            'cardQrSvg',
            'cardBackSvg'
        ));
    }

    /**
     * Serve raw SVG vector Calling Card.
     */
    public function cardSvg(string $slug, Request $request): Response
    {
        $staff = StaffVerification::where('slug', $slug)->firstOrFail();

        $side = $request->query('side', 'front');
        $includeQr = $request->boolean('qr', false);

        if ($side === 'back') {
            $svg = $this->callingCardService->generateCardBackSvg($staff);
            $filename = 'AMIS-CallingCard-' . $staff->slug . '-back.svg';
        } elseif ($includeQr) {
            $svg = $this->callingCardService->generateCardSvg($staff, true);
            $filename = 'AMIS-CallingCard-' . $staff->slug . '-with-qr.svg';
        } else {
            $svg = $this->callingCardService->generateCardSvg($staff, false);
            $filename = 'AMIS-CallingCard-' . $staff->slug . '.svg';
        }

        $disposition = $request->boolean('download') ? 'attachment' : 'inline';

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml; charset=utf-8',
            'Content-Disposition' => "{$disposition}; filename=\"{$filename}\"",
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Download QR code as vector SVG or high-res PNG.
     */
    public function downloadQr(string $slug, Request $request): Response
    {
        $staff = StaffVerification::where('slug', $slug)->firstOrFail();

        $format = $request->query('format', 'svg');
        $bg = $request->query('bg', 'white');
        $transparent = ($bg === 'transparent');

        $filename = 'AMIS-Verification-QR-' . $staff->slug . ($transparent ? '-transparent' : '-white');

        return $this->qrService->download(
            $staff->verification_url,
            $filename,
            $format,
            $transparent
        );
    }

    /**
     * Display the official AMIS Staff Directory / Verification Registry index.
     */
    public function index(Request $request): View
    {
        $query = StaffVerification::active();

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        $staffList = $query->orderBy('id', 'asc')->get();

        return view('staff.index', compact('staffList', 'search'));
    }

    /**
     * View print-ready calling card format with SVG vector cards.
     */
    public function callingCard(string $slug): View|Response
    {
        $staff = StaffVerification::where('slug', $slug)->first();

        if (!$staff || !$staff->isActive()) {
            return response()->view('staff.failed', [
                'slug' => $slug,
                'searchedStaff' => $staff,
            ], 404);
        }

        $verificationUrl = $staff->verification_url;
        $qrSvg = $this->qrService->generateSvg($verificationUrl, false, '#022c22');
        $qrSvgTransparent = $this->qrService->generateSvg($verificationUrl, true, '#022c22');

        $cardSvg = $this->callingCardService->generateCardSvg($staff, false);
        $cardQrSvg = $this->callingCardService->generateCardSvg($staff, true);
        $cardBackSvg = $this->callingCardService->generateCardBackSvg($staff);

        return view('staff.card', compact(
            'staff',
            'verificationUrl',
            'qrSvg',
            'qrSvgTransparent',
            'cardSvg',
            'cardQrSvg',
            'cardBackSvg'
        ));
    }
}
