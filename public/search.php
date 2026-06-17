<?php
require_once "../config/config.php";

$query = isset($_GET["q"]) ? trim($_GET["q"]) : "";

if (empty($query)) {
    header("Location: index.php");
    exit;
}

$stmt = $db->prepare("SELECT slug FROM locations WHERE city_name LIKE ? OR slug LIKE ? LIMIT 1");
$stmt->execute(["%$query%", "%$query%"]);
$result = $stmt->fetch();

if ($result) {
    header("Location: city.php?slug=" . $result["slug"]);
    exit;
} else {
    echo "<script>alert(\"City not found. Please try another one.\"); window.location=\"index.php\";</script>";
}
?>