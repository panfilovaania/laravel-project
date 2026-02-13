<?php

namespace PlaceholderImageGenerator;

use Illuminate\Http\Response;

class PlaceholderImageGeneratorService
{
    public function makeResponse(int $width, int $height, string $hex = '000000'): Response
    {
        $image = imagecreatetruecolor($width, $height);

        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        
        [$r, $g, $b] = sscanf($hex, "%02x%02x%02x");
        $bgColor = imagecolorallocate($image, $r, $g, $b);
        imagefill($image, 0, 0, $bgColor);

        $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
        $textColorValue = $brightness > 155 ? 0 : 255;
        $textColor = imagecolorallocate($image, $textColorValue, $textColorValue, $textColorValue);

        $text = "{$width} x {$height}";
        $font = 5;
        $fw = imagefontwidth($font);
        $fh = imagefontheight($font);
        
        $x = (int)(($width - strlen($text) * $fw) / 2);
        $y = (int)(($height - $fh) / 2);

        imagestring($image, $font, $x, $y, $text, $textColor);

        ob_start();
        imagepng($image);
        $content = ob_get_clean();

        return new Response($content, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }
}