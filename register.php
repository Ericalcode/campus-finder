<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = e($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = e($_POST["phone"]);
    $pass = password_hash($_POST["password"], PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password_hash) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $phone, $pass]);
        
        // REDIRECTION MAGIC: Send them to the login page
        header("Location: login.html?status=registered");
        exit();
        
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Error code for duplicate entry (email)
            echo "<script>alert(\"Email already registered!\"); window.location.href=\"register.html\";</script>";
        } else {
            die("Database Error: " . $e->getMessage());
        }
    }
}
?>
