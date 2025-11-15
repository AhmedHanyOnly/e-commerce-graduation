<?php

use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

if (!function_exists('store_file')) {
    function store_file($file, $path)
    {
        $name = time() . $file->getClientOriginalName();
        return $value = $file->storeAs($path, $name, 'uploads');
    }
}
if (!function_exists('delete_file')) {
    function delete_file($file)
    {
        if ($file != '' and !is_null($file) and Storage::disk('uploads')->exists($file)) {
            unlink('uploads/' . $file);
        }
    }
}
if (!function_exists('display_file')) {
    function display_file($name)
    {
        return asset('uploads') . '/' . $name;
    }
}
if (!function_exists('format_date_time')) {
    function format_date_time($datetime)
    {
        return \Carbon\Carbon::parse($datetime)->format('Y-m-d g:i A');
    }
}
if (!function_exists('return_diff_for_humans')) {
    function return_diff_for_humans($datetime)
    {
        \Carbon\Carbon::setLocale('ar');
        return \Carbon\Carbon::parse($datetime)->diffForHumans();
    }
}
if (!function_exists('calculateDistanceInKmforUsers')) {
    function calculateDistanceInKmforUsers($item1, $item2)
    {
        $lat1 = $item1->latitude;
        $lat2 = $item2->latitude;
        $lon1 = $item1->longitude;
        $lon2 = $item2->longitude;
        if ($lat1 && $lat2 && $lon1 && $lon2) {
            $earthRadius = 6371;

            $latDiff = deg2rad($lat2 - $lat1);
            $lonDiff = deg2rad($lon2 - $lon1);

            $a = sin($latDiff / 2) * sin($latDiff / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($lonDiff / 2) * sin($lonDiff / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return round($earthRadius * $c, 2);
        }
        return 0;
    }
}
if (!function_exists('calcDistanceBetweenTwoPoints')) {
    function calcDistanceBetweenTwoPoints($lat1, $lat2, $lon1, $lon2)
    {
        if ($lat1 && $lat2 && $lon1 && $lon2) {
            $earthRadius = 6371;

            $latDiff = deg2rad($lat2 - $lat1);
            $lonDiff = deg2rad($lon2 - $lon1);

            $a = sin($latDiff / 2) * sin($latDiff / 2) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                sin($lonDiff / 2) * sin($lonDiff / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            return round($earthRadius * $c, 2);
        }
        return 0;
    }
}
if (!function_exists('isCommentHasAvilableReplies')) {
    function isCommentHasAvilableReplies(Comment $comment)
    {
        $userId = auth()->check() ? auth()->user()->id : null;
        return $comment->replies()->where(function ($query) use ($userId) {
            $query->where(function ($q) use ($userId) {
                $q->where('status', 'pending')->where('user_id', $userId);
            })->orWhere('status', 'accepted');
        })->count();
    }
}

if (!function_exists('money')) {
    function money($value)
    {
        return
            '
                <svg xmlns="http://www.w3.org/2000/svg" id="saudi-riyal" width="25" viewBox="0 0 1500 1500">
                      <path d="M887.52 1234.67h0A460.06 460.06 0 0 0 849.13 1378l424.38-90.21a460.46 460.46 0 0 0 38.39-143.33ZM1273.51 1017.52A460.12 460.12 0 0 0 1311.9 874.2L981.32 944.5V809.35l292.18-62.09a460.26 460.26 0 0 0 38.39-143.33L981.31 674.18V188.11a466.3 466.3 0 0 0-132.21 111V702.29l-132.21 28.1V122A466.27 466.27 0 0 0 584.68 233V758.48L288.86 821.34a460.2 460.2 0 0 0-38.4 143.33l334.22-71v170.21L226.49 1140a460.26 460.26 0 0 0-38.39 143.33L563 1203.61a119.09 119.09 0 0 0 73.81-49.22l68.75-101.94v0a65.69 65.69 0 0 0 11.3-37V865.54l132.21-28.1v270.31l424.4-90.25Z" style="fill:#231f20"/>
                </svg>'
            . '  ' .
            number_format($value, 2, '.', '');
    }
}
