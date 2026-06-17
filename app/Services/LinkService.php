<?php
namespace App\Services;

class LinkService {
    public static function autolink(string $text, array $cities, string $lang = 'en'): string {
        foreach ($cities as $city) {
            $name = ($lang == 'en' ? $city['name_en'] : $city['name_fr']);
            $url = "/weather/{$city['province_slug']}/{$city['city_slug']}";
            $text = preg_replace('/\b' . preg_quote($name, '/') . '\b/u', '<a href="'.$url.'" class="text-canada-red hover:underline">'.$name.'</a>', $text);
        }
        return $text;
    }
}
