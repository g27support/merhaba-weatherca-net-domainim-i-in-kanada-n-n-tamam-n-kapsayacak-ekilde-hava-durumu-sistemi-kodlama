<?php
require_once "../config/config.php";
header("Content-Type: application/xml; charset=utf-8");

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";

echo "<url><loc>".SITE_URL."/?lang=en</loc><priority>1.0</priority></url>";
echo "<url><loc>".SITE_URL."/?lang=fr</loc><priority>1.0</priority></url>";

$locations = $db->query("SELECT slug FROM locations")->fetchAll();
foreach ($locations as $loc) {
    echo "<url><loc>".SITE_URL."/city.php?slug=".$loc["slug"]."</loc><priority>0.8</priority></url>";
}

$articles = $db->query("SELECT slug FROM content")->fetchAll();
foreach ($articles as $art) {
    echo "<url><loc>".SITE_URL."/article.php?slug=".$art["slug"]."</loc><priority>0.6</priority></url>";
}

echo "</urlset>";
?>