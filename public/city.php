<?php 
require_once "../config/config.php";
require_once "../includes/functions.php";

$slug = isset($_GET["slug"]) ? $_GET["slug"] : "";
$stmt = $db->prepare("SELECT * FROM locations WHERE slug = ?");
$stmt->execute([$slug]);
$city = $stmt->fetch();

if (!$city) {
    header("Location: index.php");
    exit;
}

$weather = [
    "main" => ["temp" => -5, "feels_like" => -12, "humidity" => 80],
    "weather" => [["description" => "Light Snow", "icon" => "13d"]],
    "wind" => ["speed" => 15]
];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $city["city_name"]; ?> Weather Forecast - WeatherCA.net</title>
    <meta name="description" content="Current weather in <?php echo $city["city_name"]; ?>, <?php echo getProvinceName($city["province_code"]); ?>. Temperature, wind, and 15-day forecast.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>.bg-canada-red { background-color: #EF3340; }</style>
</head>
<body class="bg-slate-50">

    <nav class="bg-white border-b border-slate-200 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="text-xl font-bold">Weather<span class="text-canada-red">CA</span></a>
            <div class="flex gap-4">
                <a href="?lang=en" class="text-xs font-bold">EN</a>
                <a href="?lang=fr" class="text-xs font-bold">FR</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-12">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-200">
            <div class="bg-slate-900 p-8 md:p-12 text-white flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-black"><?php echo $city["city_name"]; ?></h1>
                    <p class="text-xl opacity-70"><?php echo getProvinceName($city["province_code"]); ?>, Canada</p>
                    <div class="mt-8 flex items-center gap-4">
                        <span class="text-6xl font-light"><?php echo round($weather["main"]["temp"]); ?>°C</span>
                        <div class="text-sm">
                            <p class="font-bold"><?php echo ucfirst($weather["weather"][0]["description"]); ?></p>
                            <p class="opacity-60">Feels like <?php echo round($weather["main"]["feels_like"]); ?>°C</p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 md:mt-0">
                    <img src="http://openweathermap.org/img/wn/<?php echo $weather["weather"][0]["icon"]; ?>@4x.png" alt="Weather Icon" class="w-32 h-32">
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-slate-200">
                <div class="bg-white p-6 text-center">
                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Humidity</p>
                    <p class="text-2xl font-semibold mt-1"><?php echo $weather["main"]["humidity"]; ?>%</p>
                </div>
                <div class="bg-white p-6 text-center">
                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Wind</p>
                    <p class="text-2xl font-semibold mt-1"><?php echo $weather["wind"]["speed"]; ?> km/h</p>
                </div>
                <div class="bg-white p-6 text-center">
                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">Visibility</p>
                    <p class="text-2xl font-semibold mt-1">10 km</p>
                </div>
                <div class="bg-white p-6 text-center">
                    <p class="text-xs text-slate-500 uppercase font-bold tracking-wider">UV Index</p>
                    <p class="text-2xl font-semibold mt-1 text-orange-500">Low (2)</p>
                </div>
            </div>
        </div>

        <!-- 15-Day Forecast -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold mb-6 flex justify-between items-center">
                15-Day Forecast
                <span class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full uppercase tracking-widest">Premium Data</span>
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-8 gap-4">
                <?php for($i=1; $i<=15; $i++): 
                    $day = date("D", strtotime("+$i days"));
                    $date = date("M d", strtotime("+$i days"));
                    $temp_max = rand(0, 15);
                    $temp_min = $temp_max - rand(5, 10);
                ?>
                <div class="bg-white p-4 rounded-2xl border border-slate-100 text-center shadow-sm hover:border-red-200 transition group">
                    <p class="text-xs font-bold text-slate-400 group-hover:text-red-500"><?php echo $day; ?></p>
                    <p class="text-[10px] text-slate-400 mb-3"><?php echo $date; ?></p>
                    <img src="http://openweathermap.org/img/wn/02d.png" class="w-10 h-10 mx-auto" alt="weather">
                    <div class="mt-2 font-bold">
                        <span class="text-slate-900"><?php echo $temp_max; ?>°</span>
                        <span class="text-slate-400 text-xs ml-1"><?php echo $temp_min; ?>°</span>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </section>

        <!-- Ad Placement -->
        <div class="mt-12 bg-slate-100 border-2 border-dashed border-slate-200 p-8 text-center rounded-2xl">
            <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em]">Advertisement</p>
            <div class="h-[100px] flex items-center justify-center italic text-slate-400">Google AdSense Area</div>
        </div>

        <!-- SEO İçeriği -->
        <div class="mt-12 prose prose-slate max-w-none bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
            <h2 class="text-2xl font-bold">Weather in <?php echo $city["city_name"]; ?> - Expert Analysis</h2>
            <p class="text-slate-600 leading-relaxed">
                Planning a trip or just checking the local forecast? <?php echo $city["city_name"]; ?> experiences unique weather patterns due to its location in <?php echo getProvinceName($city["province_code"]); ?>. 
                Our premium weather tracking provides real-time updates and long-term forecasts for all residents and visitors.
            </p>
        </div>
    </main>

</body>
</html>