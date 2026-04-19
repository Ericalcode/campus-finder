<?php
require "header.php";
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT * FROM items WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$my_items = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>My Activity</title></head>
<body class="container">
    <h2 style="color: #4ecca3;">My Posted Items</h2>
    <div class="grid">
        <?php if(empty($my_items)): ?>
            <p>You haven't posted anything yet.</p>
        <?php endif; ?>
        <?php foreach ($my_items as $item): ?>
            <div class="glass-card">
                <div style="display:flex; justify-content:space-between;">
                    <span class="badge"><?= $item["type"] ?></span>
                    <span style="color: <?= $item["status"] == "Active" ? "#2ed573" : "#f1c40f" ?>;">
                        ● <?= $item["status"] ?>
                    </span>
                </div>
                <h3><?= htmlspecialchars($item["title"]) ?></h3>
                <p><small>Posted on: <?= date("M d, Y", strtotime($item["created_at"])) ?></small></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
