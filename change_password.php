<?php
require "header.php";
require "db.php";

if (!isset($_SESSION["user_id"])) { header("Location: login.html"); exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current = $_POST['current_pass'];
    $new = $_POST['new_pass'];
    $confirm = $_POST['confirm_pass'];

    // Fetch current hash
    $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();

    if (password_verify($current, $user['password_hash'])) {
        if ($new === $confirm) {
            $new_hash = password_hash($new, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
            $update->execute([$new_hash, $_SESSION['user_id']]);
            echo "<script>alert('Password updated successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('New passwords do not match!');</script>";
        }
    } else {
        echo "<script>alert('Current password incorrect!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Change Password</title></head>
<body class="container">
    <div class="glass-card" style="max-width:400px; margin:50px auto;">
        <h2 style="color:#e94560;">🔐 Change Password</h2>
        <form method="POST">
            <input type="password" name="current_pass" placeholder="Current Password" required style="width:100%; padding:12px; margin-bottom:15px; background:rgba(0,0,0,0.2); color:white; border:none;">
            <input type="password" name="new_pass" placeholder="New Password" required style="width:100%; padding:12px; margin-bottom:15px; background:rgba(0,0,0,0.2); color:white; border:none;">
            <input type="password" name="confirm_pass" placeholder="Confirm New Password" required style="width:100%; padding:12px; margin-bottom:15px; background:rgba(0,0,0,0.2); color:white; border:none;">
            <button type="submit" class="btn-claim" style="width:100%;">Update Password</button>
        </form>
    </div>
</body>
</html>
