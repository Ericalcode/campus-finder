<?php
require "header.php";
require "db.php";

$id = (int)$_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE items SET title=?, description=?, location_found=? WHERE item_id=?");
    $stmt->execute([$_POST['t'], $_POST['d'], $_POST['l'], $id]);
    header("Location: admin.php");
    exit();
}

$i = $pdo->query("SELECT * FROM items WHERE item_id = $id")->fetch();
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Edit Post</title></head>
<body class="container">
    <div class="glass-card" style="max-width:500px; margin:50px auto;">
        <h2>✏️ Edit Item Post</h2>
        <form method="POST">
            <input name="t" value="<?= htmlspecialchars($i['title']) ?>" style="width:100%; padding:10px; margin:10px 0; background:rgba(0,0,0,0.2); border:none; color:white;">
            <input name="l" value="<?= htmlspecialchars($i['location_found']) ?>" style="width:100%; padding:10px; margin:10px 0; background:rgba(0,0,0,0.2); border:none; color:white;">
            <textarea name="d" style="width:100%; height:100px; padding:10px; margin:10px 0; background:rgba(0,0,0,0.2); border:none; color:white;"><?= htmlspecialchars($i['description']) ?></textarea>
            <button type="submit" class="btn-claim" style="width:100%;">Save Changes</button>
        </form>
    </div>
</body>
</html>
