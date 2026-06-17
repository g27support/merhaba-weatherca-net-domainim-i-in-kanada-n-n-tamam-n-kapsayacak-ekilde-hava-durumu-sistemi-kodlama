<?php
function getWeatherData($lat, $lon, $lang = "en") {
    $apiKey = "YOUR_OPENWEATHER_API_KEY";
    $units = "metric";
    $url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units={$units}&lang={$lang}&appid={$apiKey}";
    
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function createSlug($str) {
    $str = mb_strtolower($str, "UTF-8");
    $str = str_replace(["ı", "ğ", "ü", "ş", "ö", "ç"], ["i", "g", "u", "s", "o", "c"], $str);
    $str = preg_replace("/[^a-z0-9]/", "-", $str);
    $str = preg_replace("/-+/", "-", $str);
    return trim($str, "-");
}

function getProvinceName($code) {
    $provinces = [
        "ON" => "Ontario", "QC" => "Quebec", "NS" => "Nova Scotia", 
        "NB" => "New Brunswick", "MB" => "Manitoba", "BC" => "British Columbia", 
        "PE" => "Prince Edward Island", "SK" => "Saskatchewan", "AB" => "Alberta", 
        "NL" => "Newfoundland and Labrador"
    ];
    return isset($provinces[$code]) ? $provinces[$code] : $code;
}
?>