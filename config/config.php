<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "weatherca_db");

define("SITE_URL", "https://weatherca.net");
define("DEFAULT_LANG", "en");

try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

session_start();
$lang = isset($_GET["lang"]) ? $_GET["lang"] : (isset($_SESSION["lang"]) ? $_SESSION["lang"] : "en");
if (!in_array($lang, ["en", "fr"])) $lang = "en";
$_SESSION["lang"] = $lang;

function __($key) {
    $translations = [
        "en" => [
            "search_city" => "Search for a city in Canada...",
            "latest_news" => "Latest Weather News",
            "guide" => "Canada Weather Guide"
        ],
        "fr" => [
            "search_city" => "Rechercher une ville au Canada...",
            "latest_news" => "Dernières nouvelles météo",
            "guide" => "Guide météo du Canada"
        ]
    ];
    return isset($translations[$_SESSION["lang"]][$key]) ? $translations[$_SESSION["lang"]][$key] : $key;
}
?>