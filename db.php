<?php
$host = "localhost";
$db   = "campus_finder";
$user = "root"; 
$pass = "12345678"; 
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     die("Database connection failed: " . $e->getMessage());
}

// Global sanitization function
if (!function_exists("e")) {
    function e($text) {
        return htmlspecialchars($text, ENT_QUOTES, "UTF-8");
    }
}
?>
