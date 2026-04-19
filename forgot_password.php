<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $new_hash = password_hash("12345678", PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
        $update->execute([$new_hash, $email]);
        echo "<script>alert('Success! Your password has been reset to: 12345678. Please log in and change it immediately.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Email not found in our system.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style.css"><title>Forgot Password</title></head>
<body class="container">
    <div class="glass-card" style="max-width:400px; margin:100px auto; text-align:center;">
        <h2 style="color:#f1c40f;">❓ Password Recovery</h2>
        <p style="font-size:0.9em; opacity:0.7;">Enter your email to reset your password to <b>12345678</b>.</p>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter Registered Email" required style="width:100%; padding:12px; margin:15px 0; background:rgba(0,0,0,0.2); color:white; border:none;">
            <button type="submit" class="btn-claim" style="width:100%;">Reset Password</button>
        </form>
        <br><a href="login.html" style="color:white; opacity:0.5; text-decoration:none;">Back to Login</a>
    </div>
</body>
</html>
