<?php

namespace App\Services;

use App\Models\StaffVerification;

class StaffCallingCardService
{
    protected StaffQrCodeService $qrCodeService;
    protected ?string $logoBase64 = null;

    public function __construct(StaffQrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Get the base64 encoded AMIS seal for embedding directly in SVGs.
     */
    public function getLogoBase64(): string
    {
        if ($this->logoBase64 !== null) {
            return $this->logoBase64;
        }

        $logoPath = public_path('logo.png');
        if (file_exists($logoPath)) {
            $this->logoBase64 = base64_encode(file_get_contents($logoPath));
        } else {
            $fallbackPath = public_path('images/AMIS_Logo.png');
            if (file_exists($fallbackPath)) {
                $this->logoBase64 = base64_encode(file_get_contents($fallbackPath));
            } else {
                $this->logoBase64 = '';
            }
        }

        return $this->logoBase64;
    }

    /**
     * Generate the official AMIS calling card as a pure vector SVG string.
     *
     * @param StaffVerification $staff
     * @param bool $includeQr Whether to stamp the verification QR code onto the card
     * @param bool $embedLogo Whether to embed base64 image data (recommended for downloaded SVG files)
     * @return string
     */
    public function generateCardSvg(StaffVerification $staff, bool $includeQr = false, bool $embedLogo = false): string
    {
        if ($embedLogo) {
            $logoB64 = $this->getLogoBase64();
            $sealHref = !empty($logoB64) ? "data:image/png;base64,{$logoB64}" : '/logo.png';
        } else {
            $sealHref = '/logo.png';
        }

        // Format name: uppercase with credentials
        $fullName = $staff->full_name;
        if (!empty($staff->academic_title)) {
            if (!str_contains($fullName, $staff->academic_title)) {
                $displayName = strtoupper($fullName . ', ' . $staff->academic_title);
            } else {
                $displayName = strtoupper($fullName);
            }
        } else {
            $displayName = strtoupper($fullName);
        }

        // Determine line color: blue for Cabel Nurhasan / Director, dark green for others
        $isDirector = ($staff->slug === 'cabel-nurhasan') || (stripos($staff->position ?? '', 'Director') !== false);
        $lineColor = $isDirector ? '#2468a3' : '#356422';

        $position = strtoupper($staff->position ?? 'OFFICIAL STAFF');
        $phone = $staff->phone_number ?? '+63967-249-1585';
        $email = $staff->official_email ?? 'info@amis.edu.ph';
        $website = 'www.amis.edu.ph';

        // Parse address into 2 lines
        $address = $staff->office_address ?? 'Don Julian Rodriguez Sr. Avenue, Ma-A, Davao City, 8,000, Philippines';
        $addressLines = $this->splitAddress($address);

        // QR Code block if requested
        $qrMarkup = '';
        if ($includeQr) {
            $qrSvgRaw = $this->qrCodeService->generateSvg($staff->verification_url, false, '#022c22');
            $qrPaths = preg_replace('/^.*?<svg[^>]*>/s', '', $qrSvgRaw);
            $qrPaths = preg_replace('/<\/svg>.*$/s', '', $qrPaths);

            $qrMarkup = <<<SVG
    <!-- Vector QR Code Verification Stamp -->
    <g transform="translate(565, 245)">
      <rect x="0" y="0" width="134" height="154" rx="10" fill="#ffffff" stroke="{$lineColor}" stroke-width="2" />
      <svg x="12" y="10" width="110" height="110" viewBox="0 0 33 33">
        {$qrPaths}
      </svg>
      <rect x="10" y="124" width="114" height="20" rx="4" fill="{$lineColor}" />
      <text x="67" y="138" font-family="'Cinzel', 'Times New Roman', serif" font-size="9" font-weight="700" fill="#ffffff" text-anchor="middle" letter-spacing="0.8">SCAN TO VERIFY</text>
    </g>
SVG;
        }

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 585" width="1024" height="585">
  <defs>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&amp;display=swap");
      .name-text {
        font-family: "Cinzel", "Times New Roman", "Baskerville", "Georgia", serif;
        font-weight: 700;
        font-size: 33px;
        fill: #000000;
        letter-spacing: 0.5px;
      }
      .pos-text {
        font-family: "Times New Roman", "Georgia", serif;
        font-style: italic;
        font-size: 21px;
        fill: #000000;
        letter-spacing: 1.5px;
      }
      .info-text {
        font-family: "Times New Roman", "Georgia", serif;
        font-size: 20.5px;
        fill: #000000;
        letter-spacing: 0.2px;
      }
    </style>
    <clipPath id="card-clip">
      <rect x="0" y="0" width="1024" height="585" rx="14" ry="14" />
    </clipPath>
  </defs>

  <g clip-path="url(#card-clip)">
    <!-- White Card Background -->
    <rect width="1024" height="585" fill="#ffffff" />

    <!-- Bottom Left Organic Waves -->
    <path d="M 0 435 C 45 445, 72 472, 72 505 C 72 538, 45 565, 0 585 Z" fill="#a2b194" />
    <path d="M 45 585 C 75 550, 130 550, 160 585 Z" fill="#a2b194" />
    <path d="M 0 495 L 90 585 L 0 585 Z" fill="#4a692e" />

    <!-- Bottom Right Organic Waves -->
    <path d="M 580 585 L 730 455 Q 755 435, 780 455 L 910 585 Z" fill="#a2b194" />
    <path d="M 755 585 L 1024 316 L 1024 585 Z" fill="#4a692e" />

    <!-- Official Staff Name -->
    <text x="95" y="160" class="name-text">{$displayName}</text>

    <!-- Divider Accent Line -->
    <line x1="93" y1="185" x2="898" y2="185" stroke="{$lineColor}" stroke-width="3.5" />

    <!-- Position -->
    <text x="95" y="226" class="pos-text">{$position}</text>

    <!-- Contact Info Rows -->
    <!-- Phone -->
    <g transform="translate(108, 309)">
      <circle cx="0" cy="0" r="15" fill="none" stroke="#356422" stroke-width="1.8" />
      <path d="M -5 -6 C -6 -5, -6 -3, -4 0 C -2 3, 0 5, 3 6 C 5 6, 6 5, 5 3 L 4 1 C 3.5 0.5, 2.5 0.5, 2 1 L 1 1.5 C 0.5 1, -1 0, -1.5 -1 L -1 -2 C -0.5 -2.5, -0.5 -3.5, -1 -4 L -3 -5 C -3.5 -5.5, -4.5 -5.5, -5 -6 Z" fill="#356422" />
    </g>
    <text x="142" y="316" class="info-text">{$phone}</text>

    <!-- Email -->
    <g transform="translate(109, 358)">
      <circle cx="0" cy="0" r="15" fill="none" stroke="#356422" stroke-width="1.8" />
      <rect x="-8" y="-5.5" width="16" height="11" rx="1" fill="#356422" />
      <path d="M -7 -4.5 L 0 1.5 L 7 -4.5" fill="none" stroke="#ffffff" stroke-width="1.2" />
    </g>
    <text x="142" y="365" class="info-text">{$email}</text>

    <!-- Website -->
    <g transform="translate(109, 409)">
      <circle cx="0" cy="0" r="15" fill="none" stroke="#356422" stroke-width="1.8" />
      <circle cx="0" cy="0" r="8" fill="none" stroke="#356422" stroke-width="1.2" />
      <ellipse cx="0" cy="0" rx="4" ry="8" fill="none" stroke="#356422" stroke-width="1.2" />
      <line x1="-8" y1="0" x2="8" y2="0" stroke="#356422" stroke-width="1.2" />
    </g>
    <text x="142" y="416" class="info-text">{$website}</text>

    <!-- Address -->
    <g transform="translate(111, 461)">
      <circle cx="0" cy="0" r="15" fill="none" stroke="#356422" stroke-width="1.8" />
      <path d="M 0 -8 C -4.5 -8, -6 -5, -6 -1 C -6 3, 0 8, 0 8 C 0 8, 6 3, 6 -1 C 6 -5, 4.5 -8, 0 -8 Z" fill="#356422" />
      <path d="M 0 -5 L -3 -2 L -3 2 L 3 2 L 3 -2 Z" fill="#ffffff" />
    </g>
    <text x="142" y="468" class="info-text">{$addressLines[0]}</text>
    <text x="142" y="497" class="info-text">{$addressLines[1]}</text>

    {$qrMarkup}

    <!-- AMIS Circular Seal -->
    <image href="{$sealHref}" x="727" y="214" width="208" height="208" />
  </g>
</svg>
SVG;
    }

    /**
     * Generate the official Back of Card SVG for printing and verification.
     */
    public function generateCardBackSvg(StaffVerification $staff): string
    {
        $qrSvgRaw = $this->qrCodeService->generateSvg($staff->verification_url, false, '#022c22');
        $qrPaths = preg_replace('/^.*?<svg[^>]*>/s', '', $qrSvgRaw);
        $qrPaths = preg_replace('/<\/svg>.*$/s', '', $qrPaths);

        $fullName = $staff->full_name;
        if (!empty($staff->academic_title) && !str_contains($fullName, $staff->academic_title)) {
            $displayName = strtoupper($fullName . ', ' . $staff->academic_title);
        } else {
            $displayName = strtoupper($fullName);
        }

        $position = strtoupper($staff->position ?? 'OFFICIAL STAFF');
        $url = $staff->verification_url;

        return <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 585" width="1024" height="585">
  <defs>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&amp;display=swap");
      .back-title {
        font-family: "Cinzel", "Times New Roman", serif;
        font-weight: 700;
        font-size: 25px;
        fill: #ffffff;
        letter-spacing: 2px;
        text-anchor: middle;
      }
      .back-sub {
        font-family: "Times New Roman", serif;
        font-size: 14px;
        fill: #fbbf24;
        letter-spacing: 1px;
        text-anchor: middle;
      }
      .back-name {
        font-family: "Cinzel", serif;
        font-size: 21px;
        font-weight: 700;
        fill: #ffffff;
        text-anchor: middle;
      }
      .back-pos {
        font-family: "Times New Roman", serif;
        font-style: italic;
        font-size: 15.5px;
        fill: #a7f3d0;
        text-anchor: middle;
      }
      .back-url {
        font-family: ui-monospace, monospace;
        font-size: 13px;
        fill: #d1fae5;
        text-anchor: middle;
      }
    </style>
    <clipPath id="card-clip-back">
      <rect x="0" y="0" width="1024" height="585" rx="14" ry="14" />
    </clipPath>
  </defs>

  <g clip-path="url(#card-clip-back)">
    <!-- Dark Forest Green Luxury Background -->
    <rect width="1024" height="585" fill="#022c22" />

    <!-- Subtle Diagonal Background Pattern -->
    <path d="M 0 0 L 180 0 L 0 180 Z" fill="#064e3b" opacity="0.6" />
    <path d="M 1024 585 L 844 585 L 1024 405 Z" fill="#064e3b" opacity="0.6" />

    <!-- Gold Inset Border -->
    <rect x="24" y="24" width="976" height="537" rx="8" fill="none" stroke="#d97706" stroke-width="2" stroke-dasharray="8 4" opacity="0.75" />

    <!-- School Header -->
    <text x="512" y="78" class="back-title">AL MUNAWWARA ISLAMIC SCHOOL</text>
    <text x="512" y="103" class="back-sub">OFFICIAL CREDENTIAL VERIFICATION SYSTEM &#8226; DEPED SCHOOL ID: 466150</text>

    <!-- White QR Container -->
    <rect x="412" y="136" width="200" height="200" rx="16" fill="#ffffff" stroke="#fbbf24" stroke-width="3" />
    <svg x="427" y="151" width="170" height="170" viewBox="0 0 33 33">
      {$qrPaths}
    </svg>

    <!-- Staff Info -->
    <text x="512" y="375" class="back-name">{$displayName}</text>
    <text x="512" y="400" class="back-pos">{$position}</text>

    <!-- URL Pill -->
    <rect x="280" y="420" width="464" height="34" rx="17" fill="#ffffff" fill-opacity="0.12" stroke="#ffffff" stroke-opacity="0.25" stroke-width="1" />
    <text x="512" y="442" class="back-url">{$url}</text>

    <!-- Instruction & Footer -->
    <text x="512" y="488" font-family="'Times New Roman', serif" font-size="13.5" fill="#6ee7b7" text-anchor="middle" letter-spacing="1">SCAN WITH ANY SMARTPHONE CAMERA TO CONFIRM OFFICIAL CREDENTIALS</text>
    <text x="512" y="522" font-family="'Times New Roman', serif" font-size="12" fill="#94a3b8" text-anchor="middle">Don Julian Rodriguez Sr. Avenue, Ma-A, Davao City &#8226; https://amis.edu.ph</text>
  </g>
</svg>
SVG;
    }

    /**
     * Split address into two readable lines for calling card typography.
     */
    protected function splitAddress(string $address): array
    {
        $parts = array_map('trim', explode(',', $address));
        if (count($parts) <= 1) {
            return [$address, ''];
        }

        $line1 = $parts[0] . (isset($parts[1]) && stripos($parts[1], 'Avenue') !== false ? ', ' . $parts[1] : ',');
        $remaining = array_slice($parts, (isset($parts[1]) && stripos($parts[1], 'Avenue') !== false ? 2 : 1));
        $line2 = implode(', ', $remaining);

        if (empty($line2)) {
            $line1 = $parts[0] . ',';
            $line2 = implode(', ', array_slice($parts, 1));
        }

        return [$line1, $line2];
    }
}
