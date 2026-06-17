<?php
require_once "../config/config.php";
if (isset($_SESSION["admin_logged_in"])) { header("Location: index.php"); exit; }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];
    
    $stmt = $db->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$user]);
    $admin = $stmt->fetch();
    
    if ($admin && $pass == $admin["password"]) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: index.php");
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - WeatherCA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 h-screen flex items-center justify-center">
    <form method="POST" class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-200">
        <h1 class="text-2xl font-black mb-6 text-center">Weather<span class="text-red-600">CA</span> Admin</h1>
        <?php if(isset($error)): ?>
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm font-medium"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-bold mb-1">Username</label>
                <input type="text" name="username" class="w-full p-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Password</label>
                <input type="password" name="password" class="w-full p-3 rounded-lg border border-slate-300 focus:ring-2 focus:ring-red-500 outline-none">
            </div>
            <button type="submit" class="w-full bg-slate-900 text-white font-bold py-3 rounded-lg hover:bg-slate-800 transition">Login</button>
        </div>
    </form>
</body>
</html>