<?php
require_once "../config/config.php";
require_once "../includes/functions.php";
if (!isset($_SESSION["admin_logged_in"])) { header("Location: login.php"); exit; }

$action = isset($_GET["action"]) ? $_GET["action"] : "list";
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city_name = $_POST["city_name"];
    $province_code = $_POST["province_code"];
    $lat = $_POST["latitude"];
    $lon = $_POST["longitude"];
    $slug = empty($_POST["slug"]) ? createSlug($city_name . "-" . $province_code) : createSlug($_POST["slug"]);

    if ($id > 0) {
        $stmt = $db->prepare("UPDATE locations SET city_name=?, province_code=?, latitude=?, longitude=?, slug=? WHERE id=?");
        $stmt->execute([$city_name, $province_code, $lat, $lon, $slug, $id]);
    } else {
        $stmt = $db->prepare("INSERT INTO locations (city_name, province_code, latitude, longitude, slug) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$city_name, $province_code, $lat, $lon, $slug]);
    }
    header("Location: locations.php?msg=success");
    exit;
}

if ($action == "delete" && $id > 0) {
    $stmt = $db->prepare("DELETE FROM locations WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: locations.php?msg=deleted");
    exit;
}

$loc = ["city_name"=>"", "province_code"=>"ON", "latitude"=>"", "longitude"=>"", "slug"=>""];
if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM locations WHERE id = ?");
    $stmt->execute([$id]);
    $loc = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Locations - WeatherCA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex">
    <aside class="w-64 bg-slate-900 text-white min-h-screen p-6">
        <div class="text-xl font-black mb-10">Weather<span class="text-red-500">CA</span></div>
        <nav class="space-y-2 text-sm">
            <a href="index.php" class="block p-3 rounded-lg hover:bg-slate-800">Dashboard</a>
            <a href="content_manager.php" class="block p-3 rounded-lg hover:bg-slate-800">Manage Content</a>
            <a href="locations.php" class="block p-3 rounded-lg bg-red-600 font-bold">Locations</a>
            <a href="settings.php" class="block p-3 rounded-lg hover:bg-slate-800">Settings</a>
            <a href="logout.php" class="block p-3 text-slate-400">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <?php if ($action == "list"): ?>
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-black">Canadian Locations</h1>
                <a href="locations.php?action=add" class="bg-slate-900 text-white px-4 py-2 rounded-lg font-bold">+ New Location</a>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-bold text-slate-500">
                        <tr>
                            <th class="p-4">City</th>
                            <th class="p-4">Province</th>
                            <th class="p-4">Coordinates</th>
                            <th class="p-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php
                        $locations = $db->query("SELECT * FROM locations ORDER BY city_name ASC")->fetchAll();
                        foreach($locations as $row):
                        ?>
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-bold"><?php echo $row["city_name"]; ?></td>
                            <td class="p-4 text-sm"><?php echo $row["province_code"]; ?></td>
                            <td class="p-4 text-xs text-slate-500"><?php echo $row["latitude"]; ?>, <?php echo $row["longitude"]; ?></td>
                            <td class="p-4 flex gap-2">
                                <a href="locations.php?action=edit&id=<?php echo $row["id"]; ?>" class="text-blue-600 hover:underline">Edit</a>
                                <a href="locations.php?action=delete&id=<?php echo $row["id"]; ?>" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <h1 class="text-2xl font-black mb-8"><?php echo $id > 0 ? "Edit Location" : "Add New Location"; ?></h1>
            <form method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6 max-w-2xl">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">City Name</label>
                        <input type="text" name="city_name" value="<?php echo $loc["city_name"]; ?>" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">Province Code</label>
                        <select name="province_code" class="w-full p-3 rounded-lg border border-slate-300">
                            <?php 
                            $provinces = ["AB","BC","MB","NB","NL","NS","ON","PE","QC","SK","NT","NU","YT"];
                            foreach($provinces as $p) echo "<option value='$p' ".($loc["province_code"]==$p?"selected":"").">$p</option>";
                            ?>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">Latitude</label>
                        <input type="text" name="latitude" value="<?php echo $loc["latitude"]; ?>" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase mb-2">Longitude</label>
                        <input type="text" name="longitude" value="<?php echo $loc["longitude"]; ?>" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase mb-2">Slug</label>
                    <input type="text" name="slug" value="<?php echo $loc["slug"]; ?>" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <div class="flex gap-4">
                    <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold">Save Location</button>
                    <a href="locations.php" class="bg-slate-100 px-8 py-3 rounded-xl font-bold">Cancel</a>
                </div>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>