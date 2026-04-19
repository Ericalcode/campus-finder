<?php
require "header.php";
require "db.php";

// STRICT SECURITY: Redirect anyone who is not an admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php"); 
    exit();
}

// Logic for approval...
if (isset($_GET["approve_id"])) {
    $id = (int)$_GET["approve_id"];
    $stmt = $pdo->prepare("UPDATE items SET status = \"Active\" WHERE item_id = ?");
    $stmt->execute([$id]);
}

$items = $pdo->query("SELECT * FROM items WHERE status = \"Pending\"")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Admin Approval</title></head>
<body class="container">
    <h1 style="color: #f9d342;">Admin Approval Dashboard</h1>
    <div class="grid">
        <?php if(empty($items)): ?>
            <p>No pending posts to review.</p>
        <?php endif; ?>
        <?php foreach ($items as $item): ?>
            <div class="glass-card">
                <span class="badge" style="background: #e94560;"><?= $item["type"] ?></span>
                <h3><?= htmlspecialchars($item["title"]) ?></h3>
                <p><?= htmlspecialchars($item["description"]) ?></p>
                <p><small>Found at: <?= htmlspecialchars($item["location_found"]) ?></small></p>
                <a href="admin_approve.php?approve_id=<?= $item["item_id"] ?>" class="btn-claim" style="background: #2ed573; display: block; text-align: center; text-decoration: none;">Approve & Publish</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
