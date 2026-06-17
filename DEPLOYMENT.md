# WeatherCA.net — Deployment Guide & Launch Checklist

## 1. Server Requirements
- **PHP**: 8.2 or 8.3
- **Extensions**: PDO, PDO_MYSQL, JSON, MBSTRING, CURL
- **Web Server**: Apache (with mod_rewrite) or Nginx
- **Database**: MariaDB 10.11+ or MySQL 8.0+

## 2. Web Server Configuration

### Nginx Example
```nginx
server {
    listen 80;
    server_name weatherca.net;
    root /var/www/weatherca;

    index public/index.php;

    location / {
        try_files $uri $uri/ /public/index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
    }

    location ~ ^/(app|config|lang|sql|storage|views)/ {
        deny all;
    }
}
```

## 3. Cron Job Setup (Critical)
To keep weather data fresh and alerts active, add this to your crontab (`crontab -e`):

```bash
# Update weather every 30 minutes
*/30 * * * * /usr/bin/php /var/www/weatherca/app/Bin/fetch-weather.php >> /var/www/weatherca/storage/logs/cron.log 2>&1
```

## 4. Permissions
Ensure the storage directory is writable by the web server (e.g., www-data):
```bash
chmod -R 775 /var/www/weatherca/storage
chown -R www-data:www-data /var/www/weatherca/storage
```

## 5. Pre-Launch QA Checklist (Top 10)
1. [ ] **API Key**: Ensure OpenWeatherMap API key is in `config/config.php`.
2. [ ] **Admin Path**: Change `admin_path` in `config/config.php` to something unique.
3. [ ] **DB Connection**: Update DB credentials in `config/config.php`.
4. [ ] **SSL**: Verify Let's Encrypt / SSL is active and forcing HTTPS.
5. [ ] **Hreflang**: Check `<link rel="alternate" hreflang="fr">` tags on city pages.
6. [ ] **Sitemap**: Verify `weatherca.net/sitemap.php` renders valid XML.
7. [ ] **Robots**: Check `weatherca.net/robots.txt` is visible.
8. [ ] **Bilingual**: Check toggle EN/FR on Home, City, and Blog.
9. [ ] **Speed**: Check X-Cache header (should be HIT on second load).
10. [ ] **Mobile**: Test search and menu on mobile devices.
