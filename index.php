<?php
require "header.php";
require "db.php";

if (!isset($_SESSION["user_id"])) { header("Location: welcome.php"); exit(); }

$items = $pdo->query("SELECT items.*, users.name FROM items JOIN users ON items.user_id = users.user_id WHERE status = 'Active' ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard | Campus Finder</title>
</head>
<body class="container">
    <div class="glass-card" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="margin:0; color:#e94560;">Hello, <?= htmlspecialchars($_SESSION['name']) ?></h2>
            <a href="change_password.php" style="color:#3498db; font-size:0.8em; text-decoration:none;">⚙️ Change Password</a>
        </div>
        <a href="post_item.php" class="btn-claim" style="text-decoration:none; padding: 12px 20px;">+ Post New Item</a>
    </div>

    <h3 style="margin-top:30px; color:#f1c40f;">Live Campus Feed</h3>
    
    <div class="grid">
        <?php if (!empty($items)): ?>
            <?php foreach($items as $i): ?>
                <div class="glass-card" style="border-top: 3px solid <?= $i['type']=='Found'?'#4ecca3':'#e94560'?>;">
                    <span style="background:<?= $i['type']=='Found'?'#4ecca3':'#e94560'?>; padding:2px 8px; border-radius:4px; font-size:0.8em; color:#1a1a2e; font-weight:bold;"><?= $i['type'] ?></span>
                    
                    <?php if($i['item_image']): ?>
                        <img src="uploads/<?= $i['item_image'] ?>" style="width:100%; height:180px; object-fit:cover; border-radius:8px; margin: 15px 0;">
                    <?php endif; ?>

                    <h3 style="margin:10px 0;"><?= htmlspecialchars($i['title']) ?></h3>
                    <p style="font-size:0.9em; opacity:0.8;"><?= htmlspecialchars($i['description']) ?></p>
                    <p>📍 <b>At:</b> <?= htmlspecialchars($i['location_found']) ?></p>
                    <p>🏦 <b>Kept at:</b> <?= htmlspecialchars($i['current_location']) ?></p>
                    <hr style="border:0; border-top:1px solid rgba(255,255,255,0.1); margin:10px 0;">
                    <a href="https://wa.me/254<?= preg_replace("/[^0-9]/", "", $i["contact_phone"]) ?>" class="btn-claim" style="display:block; text-align:center; background:#25D366; text-decoration:none;">Contact Finder</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="glass-card" style="grid-column: 1/-1; text-align:center; padding:60px 20px;">
                <div style="font-size: 4em; margin-bottom: 20px;">🎉</div>
                <h3 style="color:#4ecca3;">All quiet on campus!</h3>
                <p style="opacity:0.7;">No lost or found items reported yet. Enjoy your day!</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
