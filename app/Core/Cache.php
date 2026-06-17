<?php
namespace App\Core;

class Cache {
    private static $cache_dir = __DIR__ . '/../../storage/cache/pages';
    private static $expiry = 3600; // 1 hour default

    public static function init() {
        if (!is_dir(self::$cache_dir)) {
            mkdir(self::$cache_dir, 0777, true);
        }
    }

    public static function get(string $key) {
        $file = self::getFilePath($key);
        if (file_exists($file) && (time() - filemtime($file)) < self::$expiry) {
            return file_get_contents($file);
        }
        return null;
    }

    public static function set(string $key, string $content) {
        self::init();
        $file = self::getFilePath($key);
        file_put_contents($file, $content);
    }

    public static function clear() {
        if (is_dir(self::$cache_dir)) {
            array_map('unlink', glob(self::$cache_dir . "/*"));
        }
    }

    private static function getFilePath(string $key): string {
        return self::$cache_dir . '/' . md5($key) . '.cache';
    }
}
