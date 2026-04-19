<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "db.php";

echo "<h1>Database Test</h1>";
try {
    $stmt = $pdo->query("SELECT * FROM news");
    $results = $stmt->fetchAll();
    echo "Found " . count($results) . " items in the news table.<br><br>";
    foreach($results as $row) {
        echo "Title: " . $row['title'] . "<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
