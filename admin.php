<?php
require "header.php";
require "db.php";

// DEBUG: Remove this bar once your session is working perfectly
$role = $_SESSION['role'] ?? 'Guest';
echo "<div style='background:#1a1a2e; color:#f1c40f; padding:10px; border-bottom:1px solid #e94560; text-align:center;'>
        Logged in as: <b>".htmlspecialchars($_SESSION['name'] ?? 'Unknown')."</b> | Role: <b>$role</b>
      </div>";

// 1. Logic: Actions (Approve, Delete, News)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($_GET['action'] === 'approve') {
        $pdo->prepare("UPDATE items SET status = 'Active' WHERE item_id = ?")->execute([$id]);
    } elseif ($_GET['action'] === 'delete') {
        $pdo->prepare("DELETE FROM items WHERE item_id = ?")->execute([$id]);
    } elseif ($_GET['action'] === 'del_news') {
        $pdo->prepare("DELETE FROM news WHERE news_id = ?")->execute([$id]);
    }
    header("Location: admin.php");
    exit();
}

// 2. Logic: Post News
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_news'])) {
    $stmt = $pdo->prepare("INSERT INTO news (title, content) VALUES (?, ?)");
    $stmt->execute([$_POST['news_title'], $_POST['news_content']]);
    header("Location: admin.php");
    exit();
}

// 3. Fetch Everything
$items = $pdo->query("SELECT items.*, users.name FROM items JOIN users ON items.user_id = users.user_id ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
$news = $pdo->query("SELECT * FROM news ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Admin Shield | Kirinyaga University</title>
</head>
<body class="container">
    <h1 style="color: #f1c40f; margin-top:20px;">🛡️ Admin Shield Dashboard</h1>

    <div class="grid">
        <div class="glass-card">
            <h3>📢 Broadcast News</h3>
            <form method="POST">
                <input type="text" name="news_title" placeholder="Headline" required style="width:100%; padding:10px; margin-bottom:10px; background:rgba(0,0,0,0.2); border:none; color:white;">
                <textarea name="news_content" placeholder="Details..." required style="width:100%; height:80px; padding:10px; background:rgba(0,0,0,0.2); border:none; color:white;"></textarea>
                <button type="submit" name="post_news" class="btn-claim" style="width:100%; margin-top:10px;">Post to Welcome Page</button>
            </form>
            <div style="margin-top:20px; max-height:150px; overflow-y:auto;">
                <?php foreach($news as $n): ?>
                    <div style="display:flex; justify-content:space-between; padding:5px; border-bottom:1px solid rgba(255,255,255,0.1);">
                        <small><?= htmlspecialchars($n['title']) ?></small>
                        <a href="admin.php?action=del_news&id=<?= $n['news_id'] ?>" style="color:#ff4757; text-decoration:none;">[x]</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="glass-card">
            <h3>📊 Platform Stats</h3>
            <p>Total Items: <?= count($items) ?></p>
            <p>Pending Posts: <?php 
                echo count(array_filter($items, function($i){ return $i['status'] == 'Pending'; })); 
            ?></p>
            <hr style="border:0; border-top:1px solid rgba(255,255,255,0.1); margin:15px 0;">
            <a href="welcome.php" style="color:#4ecca3; text-decoration:none;">View Welcome Page</a><br>
            <a href="index.php" style="color:#f1c40f; text-decoration:none;">View User Dashboard</a>
        </div>
    </div>

    <div class="glass-card" style="margin-top:30px;">
        <h3>📦 Review & Approve Posts</h3>
        <table style="width:100%; color:white; border-collapse: collapse; margin-top:15px;">
            <tr style="border-bottom: 2px solid #e94560; text-align:left;">
                <th style="padding:10px;">Item</th>
                <th>Posted By</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($items as $i): ?>
            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                <td style="padding:15px;">
                    <b><?= htmlspecialchars($i['title']) ?></b><br>
                    <small style="opacity:0.6;"><?= htmlspecialchars($i['location_found']) ?></small>
                </td>
                <td><?= htmlspecialchars($i['name']) ?></td>
                <td style="color: <?= $i['status']=='Active' ? '#2ed573' : '#f1c40f' ?>;">
                    <?= $i['status'] ?>
                </td>
                <td>
                    <?php if($i['status'] === 'Pending'): ?>
                        <a href="admin.php?action=approve&id=<?= $i['item_id'] ?>" style="color:#2ed573; text-decoration:none; font-weight:bold;">[Approve]</a> |
                    <?php endif; ?>
                    <a href="edit_item.php?id=<?= $i['item_id'] ?>" style="color:#3498db; text-decoration:none;">[Edit]</a> |
                    <a href="admin.php?action=delete&id=<?= $i['item_id'] ?>" style="color:#ff4757; text-decoration:none;" onclick="return confirm('Delete permanently?')">[Delete]</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
