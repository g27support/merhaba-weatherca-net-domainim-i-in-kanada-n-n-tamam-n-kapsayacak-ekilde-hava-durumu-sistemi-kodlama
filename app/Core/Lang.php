<?php
namespace App\Core;

class Lang {
    private static $translations = [];
    private static $currentLang = 'en';

    public static function load(string $lang) {
        self::$currentLang = $lang;
        $path = __DIR__ . "/../../lang/{$lang}.json";
        if (file_exists($path)) {
            self::$translations = json_decode(file_get_contents($path), true);
        }
    }

    public static function t(string $key) {
        $keys = explode('.', $key);
        $result = self::$translations;
        foreach ($keys as $k) {
            if (isset($result[$k])) {
                $result = $result[$k];
            } else {
                return $key;
            }
        }
        return $result;
    }

    public static function current() {
        return self::$currentLang;
    }
}
