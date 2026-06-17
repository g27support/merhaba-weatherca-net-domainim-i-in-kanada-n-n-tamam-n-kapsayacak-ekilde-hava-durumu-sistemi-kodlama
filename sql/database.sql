CREATE DATABASE IF NOT EXISTS weatherca_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE weatherca_db;

CREATE TABLE settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    site_key VARCHAR(50) UNIQUE,
    site_value TEXT
);

CREATE TABLE locations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    city_name VARCHAR(100),
    province_code CHAR(2),
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    slug VARCHAR(150) UNIQUE,
    is_premium TINYINT(1) DEFAULT 0
);

CREATE TABLE content (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type ENUM("blog", "guide") DEFAULT "blog",
    lang ENUM("en", "fr") DEFAULT "en",
    title VARCHAR(255),
    slug VARCHAR(255),
    body LONGTEXT,
    meta_title VARCHAR(255),
    meta_desc TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO admins (username, password) VALUES ("admin", "admin123");

INSERT INTO locations (city_name, province_code, latitude, longitude, slug) VALUES 
("Toronto", "ON", 43.6532, -79.3832, "toronto-on"),
("Montreal", "QC", 45.5017, -73.5673, "montreal-qc"),
("Vancouver", "BC", 49.2827, -123.1207, "vancouver-bc"),
("Calgary", "AB", 51.0447, -114.0719, "calgary-ab"),
("Ottawa", "ON", 45.4215, -75.6972, "ottawa-on");

INSERT INTO content (type, lang, title, slug, body, meta_title, meta_desc) VALUES 
("guide", "en", "Winter Driving Safety in Canada", "winter-driving-safety", "Canada winters can be harsh. Always check your tire pressure and keep a winter emergency kit in your car...", "Winter Driving Guide - WeatherCA", "Essential tips for driving in Canadian winter conditions."),
("blog", "en", "Record Snowfall in British Columbia", "record-snowfall-bc", "This season has seen unprecedented snowfall levels across BC...", "BC Snowfall Records - WeatherCA", "News report on record snowfall levels in British Columbia.");