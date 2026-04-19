<?php
require_once "db.php";
$q = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
$list = $q->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Welcome | Campus Finder</title>
</head>
<body class="container">
    <nav class="glass-card" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding: 15px 25px;">
        <div style="font-size: 1.5em; font-weight: bold; color: #e94560;">Campus Finder</div>
        <div style="display: flex; gap: 15px;">
            <a href="login.html" class="btn-claim" style="text-decoration: none; padding: 10px 20px;">Login</a>
            <a href="register.html" class="btn-claim" style="text-decoration: none; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); padding: 10px 20px;">Register</a>
        </div>
    </nav>

    <div style="margin-bottom: 20px;">
        <h2 style="color: #f1c40f; display: flex; align-items: center; gap: 10px;">
            📢 Latest Campus News & Updates
        </h2>
    </div>

    <div class="grid">
        <?php if (!empty($list)): ?>
            <?php foreach($list as $n): ?>
                <div class="glass-card" style="border-top: 3px solid #e94560;">
                    <h3 style="margin-top: 0; color: #e94560;"><?php echo htmlspecialchars($n["title"]); ?></h3>
                    <p style="line-height: 1.6; opacity: 0.9;">
                        <?php echo nl2br(htmlspecialchars($n["content"])); ?>
                    </p>
                    <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 15px 0;">
                    <small style="opacity: 0.5;">📅 Published: <?php echo date("M d, Y", strtotime($n["created_at"])); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="glass-card" style="grid-column: 1/-1; text-align: center; padding: 40px;">
                <p style="opacity: 0.6;">No announcements have been posted yet. Check back soon!</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>