<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Output\QRMarkupSVG;
use chillerlan\QRCode\Output\QRGdImagePNG;
use Illuminate\Http\Response;

class StaffQrCodeService
{
    /**
     * Generate vector SVG markup.
     */
    public function generateSvg(string $url, bool $transparent = false, string $darkColor = '#022c22'): string
    {
        $options = new QROptions([
            'outputInterface' => QRMarkupSVG::class,
            'outputBase64' => false,
            'svgAddXmlHeader' => true,
            'svgUseFillAttributes' => true,
            'drawLightModules' => !$transparent,
            'quietzoneSize' => 2,
        ]);

        $svg = (new QRCode($options))->render($url);

        // Apply dark color brand style
        if ($darkColor && strtolower($darkColor) !== '#000' && strtolower($darkColor) !== '#000000') {
            $svg = preg_replace('/fill="#000(000)?"/i', 'fill="' . htmlspecialchars($darkColor) . '"', $svg);
        }

        return $svg;
    }

    /**
     * Generate data URI for direct <img> embedding.
     */
    public function generateDataUri(string $url, bool $transparent = false, string $darkColor = '#022c22'): string
    {
        $svg = $this->generateSvg($url, $transparent, $darkColor);
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /**
     * Generate high-res PNG binary data (requires GD or Imagick).
     */
    public function generatePng(string $url, bool $transparent = false, int $scale = 20): ?string
    {
        if (!extension_loaded('gd') && !extension_loaded('imagick')) {
            return null;
        }

        try {
            $options = new QROptions([
                'outputInterface' => QRGdImagePNG::class,
                'outputBase64' => false,
                'scale' => $scale,
                'imageTransparent' => $transparent,
                'quietzoneSize' => 2,
            ]);

            return (new QRCode($options))->render($url);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Stream or download QR code file with attachment headers.
     */
    public function download(string $url, string $filename, string $format = 'svg', bool $transparent = false): Response
    {
        if (strtolower($format) === 'png') {
            $png = $this->generatePng($url, $transparent);
            if ($png !== null) {
                return response($png, 200, [
                    'Content-Type' => 'image/png',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '.png"',
                    'Cache-Control' => 'public, max-age=86400',
                ]);
            }
        }

        // SVG (vector)
        $svg = $this->generateSvg($url, $transparent);
        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.svg"',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
