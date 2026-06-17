<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | WeatherCA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 bg-slate-800 rounded-3xl shadow-2xl border border-slate-700">
        <h1 class="text-3xl font-black text-white mb-8 text-center uppercase tracking-tighter">
            Weather<span class="text-canada-red">CA</span> Admin
        </h1>
        
        <?php if ($error): ?>
            <div class="bg-red-500/10 text-red-500 p-4 rounded-xl mb-6 text-sm font-bold border border-red-500/20">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Username</label>
                <input type="text" name="username" class="w-full bg-slate-700 border border-slate-600 rounded-xl px-5 py-4 text-white focus:outline-none focus:ring-2 focus:ring-canada-red transition" required>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-400 mb-2 tracking-widest">Password</label>
                <input type="password" name="password" class="w-full bg-slate-700 border border-slate-600 rounded-xl px-5 py-4 text-white focus:outline-none focus:ring-2 focus:ring-canada-red transition" required>
            </div>
            <button type="submit" class="w-full bg-canada-red text-white font-black uppercase py-4 rounded-xl hover:bg-white hover:text-slate-900 transition duration-300">
                Secure Login
            </button>
        </form>
    </div>
</body>
</html>
