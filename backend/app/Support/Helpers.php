<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

if (! function_exists('generate_text_depth_tree')) {
    /**
     * Tạo text theo độ sâu.
     *
     * @param integer $depth
     */
    function generate_text_depth_tree($depth, $word = '-')
    {
        $text = '';
        if ($depth > 0) {
            for ($i = 0; $i < $depth; $i++) {
                $text .= $word;
            }
        }
        return $text;
    }
}
if (! function_exists('uniqid_real')) {
    function uniqid_real($lenght = 13)
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return Str::upper(substr(bin2hex($bytes), 0, $lenght));
    }
}

if (! function_exists('format_price')) {
    function format_price($price, $positionCurrent = 0)
    {
        if ($positionCurrent == 'left') {
            return config('custom.currency') . number_format($price);
        } else {
            return number_format($price) . ' ' . config('custom.currency');
        }
    }
}

if (! function_exists('format_price_miniapp')) {
    function format_price_miniapp($price, $positionCurrent = 0)
    {
        if ($positionCurrent == 'left') {
            return config('custom.currency') . number_format($price);
        } else {
            return number_format($price) . ' ' . config('custom.currency');
        }
    }
}

if (! function_exists('format_point')) {
    function format_point($point)
    {
        return number_format($point);
    }
}

if (!function_exists('format_date')) {
    /**
     * Format a date or return an empty string if the input is null.
     *
     * @param string|\DateTimeInterface|null $date
     * @param string $format
     * @return string
     */
    function format_date($date, $format = 'Y-m-d'): string
    {
        if ($date === null) {
            return '';
        }

        if (is_string($date)) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                return ''; // Return empty string if the date string is invalid
            }
        }

        return $date->format($format);
    }
}


if (!function_exists('format_date_user')) {
    /**
     * Format a date or return an empty string if the input is null.
     *
     * @param string|\DateTimeInterface|null $date
     * @param string $format
     * @return string
     */
    function format_date_user($date, $format = 'd-m-Y'): string
    {
        if ($date === null) {
            return '';
        }

        if (is_string($date)) {
            try {
                $date = new \DateTime($date);
            } catch (\Exception $e) {
                return ''; // Return empty string if the date string is invalid
            }
        }

        return $date->format($format);
    }
}


if (!function_exists('format_datetime')) {
    function format_datetime($datetime, $format = null): ?string
    {
        if ($datetime) {
            $format = $format ?: config('custom.format.datetime');
            return date($format, strtotime($datetime));
        }
        return null;
    }
}


if (!function_exists('format_time')) {
    /**
     * Formats the time portion of a datetime string.
     *
     * @param string|null $datetime The datetime string to format.
     * @param string|null $format The time format to use, defaults to a configuration or 'H:i:s'.
     * @return string|null Formatted time or null if input is null.
     */
    function format_time($datetime, $format = null): ?string
    {
        if ($datetime) {
            // Set the default format from configuration or use 'H:i:s' if not configured
            $format = $format ?: config('custom.format.time', 'H:i:s');
            return date($format, strtotime($datetime));
        }
        return null;
    }
}

if (!function_exists('getBoundsByName')) {
    /**
     * Lấy khung giới hạn cho một địa điểm cụ thể bằng cách sử dụng Google Geocoding API.
     *
     * @param string $name Tên địa điểm cần truy vấn.
     * @return array|null Mảng khung giới hạn hoặc null nếu không tìm thấy.
     */
    function getBoundsByName(string $name): ?array
    {
        $apiKey = config('services.google_maps.api_key');
        $encodedName = urlencode($name);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$encodedName}&key={$apiKey}";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['results']) && isset($data['results'][0]['geometry']['bounds'])) {
                return $data['results'][0]['geometry']['bounds'];
            } else {
                return null;
            }
        }

        return null;
    }

    function format_money(int|float $v): string
    {
        return number_format($v, 0, ',', '.') . '₫';
    }

    /**
     * Tạo mô tả đơn hàng chi tiết kèm giá gốc - giảm - tổng.
     *
     * @param  \App\Models\Booking  $booking  Đối tượng booking đã eager-load:
     *         bookingDetails.roomTypeVariant.roomType,
     *         bookingServices.hotelService,
     *         bookingCombos.combo,
     *         voucher (nullable)
     *
     * @return string
     */
    function buildOrderDescriptionDetailed(\App\Models\Booking $booking): string
    {
        $lines        = [];
        $totalOrigin  = 0;
        $totalPayable = 0;

        foreach ($booking->bookingDetails as $detail) {
            $variant = $detail->variant;
            $roomType = $variant?->roomType;

            if (!$variant || !$roomType) {
                $lines[] = "🛏 (Phòng không xác định)";
                continue;
            }

            $roomName = $roomType->name ?? 'Phòng';
            $qty      = $detail->quantity ?? 1;
            $origin   = $variant->discount_price ?: $variant->base_price;
            $final    = $detail->price_per_room ?? 0;

            $discLbl = $origin == $final
                ? ''
                : ' → ' . format_money($final) .
                ' (-' . format_money($origin - $final) . ')';

            $totalOrigin  += $origin * $qty;
            $totalPayable += $final  * $qty;

            $lines[] = "🛏 {$roomName} ({$qty} phòng x " . format_money($origin) . $discLbl . ')';
        }

        /** 🧾 Dịch vụ */
        if ($booking->bookingServices->count()) {
            $serviceParts = [];
            foreach ($booking->bookingServices as $item) {
                $sv = $item->hotelService;

                if (!$sv) continue;

                $name     = $sv->service->name;
                $qty      = $item->quantity;
                $origin   = $sv->promo_price != null && $sv->promo_price > 0  ? $sv->promo_price : $sv->base_price ;
                $final    = $item->price ?? $final; 

                $discLbl = $origin == $final
                    ? ''
                    : ' → ' . format_money($final) .
                    ' (-' . format_money($origin - $final) . ')';

                $serviceParts[] = "{$name} ({$qty} x " . format_money($origin) . $discLbl . ')';

                $totalOrigin  += $origin * $qty;
                $totalPayable += $final  * $qty;
            }
            $lines[] = '🧾 Dịch vụ: ' . implode(', ', $serviceParts);
        }

        /** 🎁 Combo */
        if ($booking->bookingCombos->count()) {
            $comboParts = [];
            foreach ($booking->bookingCombos as $item) {
                $combo = $item->combo;

                if (!$combo) continue;

                $name     = $combo->name;
                $qty      = $item->quantity;
                $origin   = $combo->combo_price ?? 0;
                $final    = $item->price ?? 0;

                $discLbl = $origin == $final
                    ? ''
                    : ' → ' . format_money($final) .
                    ' (-' . format_money($origin - $final) . ')';

                $comboParts[] = "{$name} ({$qty} x " . format_money($origin) . $discLbl . ')';

                $totalOrigin  += $origin * $qty;
                $totalPayable += $final  * $qty;
            }
            $lines[] = '🎁 Combo: ' . implode(', ', $comboParts);
        }

        /** 🎟️ Voucher */
        if ($booking->voucher) {
            $v        = $booking->voucher;
            $discount = 0;

            if ($v->discount_type == 0) {
                $discount = $v->discount_value;
            } else {
                $discount = min(
                    $totalPayable * ($v->discount_value / 100),
                    $v->max_discount_value ?? PHP_INT_MAX
                );
            }

            $totalPayable -= $discount;
            $lines[] = "🎟️ Voucher: {$v->code} (-" . format_money($discount) . ')';
        }

        /** 💰 Tổng */
        $saved = $totalOrigin - $totalPayable;
        $lines[] = '💰 Tổng tiền: ' . format_money($totalPayable) .
            ($saved > 0 ? ' (Tiết kiệm ' . format_money($saved) . ')' : '');

        return implode("\n", $lines);
    }
}
