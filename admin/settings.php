<?php
require_once "../config/config.php";
if (!isset($_SESSION["admin_logged_in"])) { header("Location: login.php"); exit; }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST["settings"] as $key => $value) {
        $stmt = $db->prepare("INSERT INTO settings (site_key, site_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE site_value = ?");
        $stmt->execute([$key, $value, $value]);
    }
    $msg = "Settings updated successfully.";
}

$settings_res = $db->query("SELECT * FROM settings")->fetchAll();
$settings = [];
foreach ($settings_res as $s) $settings[$s["site_key"]] = $s["site_value"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>General Settings - WeatherCA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 flex">
    <aside class="w-64 bg-slate-900 text-white min-h-screen p-6">
        <div class="text-xl font-black mb-10">Weather<span class="text-red-500">CA</span></div>
        <nav class="space-y-2 text-sm">
            <a href="index.php" class="block p-3 rounded-lg hover:bg-slate-800">Dashboard</a>
            <a href="content_manager.php" class="block p-3 rounded-lg hover:bg-slate-800">Manage Content</a>
            <a href="locations.php" class="block p-3 rounded-lg hover:bg-slate-800">Locations</a>
            <a href="settings.php" class="block p-3 rounded-lg bg-red-600 font-bold">Settings</a>
            <a href="logout.php" class="block p-3 text-slate-400">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-10">
        <h1 class="text-2xl font-black mb-8">System Settings</h1>
        
        <?php if(isset($msg)): ?>
            <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 font-bold border border-green-200"><?php echo $msg; ?></div>
        <?php endif; ?>

        <form method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-6 max-w-3xl">
            <div class="space-y-4">
                <h3 class="text-sm font-black uppercase text-slate-400 tracking-widest">API Configuration</h3>
                <div>
                    <label class="block text-xs font-bold mb-1">OpenWeatherMap API Key</label>
                    <input type="text" name="settings[weather_api_key]" value="<?php echo $settings["weather_api_key"] ?? ""; ?>" class="w-full p-3 rounded-lg border border-slate-300 outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>

            <div class="space-y-4 pt-6">
                <h3 class="text-sm font-black uppercase text-slate-400 tracking-widest">SEO & Branding</h3>
                <div>
                    <label class="block text-xs font-bold mb-1">Site Title</label>
                    <input type="text" name="settings[site_title]" value="<?php echo $settings["site_title"] ?? "WeatherCA.net"; ?>" class="w-full p-3 rounded-lg border border-slate-300">
                </div>
                <div>
                    <label class="block text-xs font-bold mb-1">Meta Description</label>
                    <textarea name="settings[site_desc]" rows="3" class="w-full p-3 rounded-lg border border-slate-300"><?php echo $settings["site_desc"] ?? ""; ?></textarea>
                </div>
            </div>

            <div class="space-y-4 pt-6">
                <h3 class="text-sm font-black uppercase text-slate-400 tracking-widest">Social Media</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold mb-1">Facebook URL</label>
                        <input type="text" name="settings[fb_url]" value="<?php echo $settings["fb_url"] ?? ""; ?>" class="w-full p-3 rounded-lg border border-slate-300">
                    </div>
                    <div>
                        <label class="block text-xs font-bold mb-1">Twitter URL</label>
                        <input type="text" name="settings[tw_url]" value="<?php echo $settings["tw_url"] ?? ""; ?>" class="w-full p-3 rounded-lg border border-slate-300">
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="bg-slate-900 text-white px-10 py-3 rounded-xl font-bold hover:bg-slate-800 transition">Save All Settings</button>
            </div>
        </form>
    </main>
</body>
</html>