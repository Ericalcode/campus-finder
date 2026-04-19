<?php
require 'db.php';

// Archive items older than 60 days that are still 'Active'
$sql = "UPDATE items SET status = 'Archived' 
        WHERE created_at < DATE_SUB(NOW(), INTERVAL 60 DAY) 
        AND status = 'Active'";

$stmt = $pdo->prepare($sql);
$stmt->execute();

echo "Archived " . $stmt->rowCount() . " old posts.";
?>
