<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user["password_hash"])) {
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["name"] = $user["name"];
        $_SESSION["role"] = $user["role"]; // THIS LINE IS CRITICAL
        $_SESSION["reputation"] = $user["reputation"];

        // Redirect based on role
        if ($user["role"] === "admin") {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid Credentials'); window.location.href='login.html';</script>";
    }
}
?>
