<?php
require "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Content-Type: application/json");
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

$query = isset($_GET["q"]) ? "%" . $_GET["q"] . "%" : "%";

try {
    // Only fetch items that are "Active" (Approved by Admin)
    $stmt = $pdo->prepare("SELECT items.*, users.name as poster_name 
                           FROM items 
                           JOIN users ON items.user_id = users.user_id 
                           WHERE (title LIKE ? OR description LIKE ?) 
                           AND status = \"Active\" 
                           ORDER BY created_at DESC");
    $stmt->execute([$query, $query]);
    $items = $stmt->fetchAll();

    header("Content-Type: application/json");
    echo json_encode($items);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
