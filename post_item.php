<?php
require "header.php";
require "db.php";

if (!isset($_SESSION["user_id"])) { header("Location: login.html"); exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = e($_POST['title']);
    $desc = e($_POST['description']);
    $loc_found = e($_POST['location_found']);
    $loc_kept = e($_POST['current_location']);
    $phone = e($_POST['contact_phone']);
    $type = $_POST['type'];
    $image_name = null;

    if (isset($_FILES['item_image']) && $_FILES['item_image']['error'] == 0) {
        $target_dir = "uploads/";
        $file_ext = strtolower(pathinfo($_FILES["item_image"]["name"], PATHINFO_EXTENSION));
        $image_name = "IMG_" . time() . "_" . rand(1000, 9999) . "." . $file_ext;
        if (!move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_dir . $image_name)) {
            $image_name = null; 
        }
    }

    $stmt = $pdo->prepare("INSERT INTO items (user_id, title, description, location_found, current_location, contact_phone, type, status, item_image) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', ?)");
    
    if($stmt->execute([$user_id, $title, $desc, $loc_found, $loc_kept, $phone, $type, $image_name])) {
        echo "<script>alert('Submitted! Waiting for Admin approval.'); window.location.href='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Post Item | Campus Finder</title>
</head>
<body class="container">
    <div class="glass-card" style="max-width: 500px; margin: 20px auto;">
        <h2 style="color: #e94560; text-align:center;">📤 Report Item</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Item Type</label>
            <select name="type" required style="width:100%; padding:12px; margin-bottom:15px; background:rgba(255,255,255,0.1); color:white; border:none; border-radius:5px;">
                <option value="Found">I Found something</option>
                <option value="Lost">I Lost something</option>
            </select>

            <label>Photo (Optional)</label>
            <input type="file" name="item_image" accept="image/*" style="margin-bottom:15px; color:white; display:block;">

            <input type="text" name="title" placeholder="Item Name (e.g. Keys)" required style="width:100%; padding:12px; margin-bottom:15px; background:rgba(255,255,255,0.1); color:white; border:none; border-radius:5px;">
            
            <input type="text" name="location_found" placeholder="Where was it found/lost?" required style="width:100%; padding:12px; margin-bottom:15px; background:rgba(255,255,255,0.1); color:white; border:none; border-radius:5px;">

            <input type="text" name="current_location" placeholder="Where is it now? (e.g. Security Desk)" required style="width:100%; padding:12px; margin-bottom:15px; background:rgba(255,255,255,0.1); color:white; border:none; border-radius:5px;">

            <label>WhatsApp Number</label>
            <div style="display:flex; margin-bottom:15px; background:rgba(255,255,255,0.1); border-radius:5px; overflow:hidden;">
                <span style="padding:12px; background:rgba(255,255,255,0.1); color:#f1c40f; font-weight:bold;">+254</span>
                <input type="tel" name="contact_phone" placeholder="712345678" pattern="[0-9]{9}" required style="flex:1; padding:12px; background:transparent; color:white; border:none; outline:none;">
            </div>

            <textarea name="description" placeholder="Any other details..." style="width:100%; height:80px; padding:12px; background:rgba(255,255,255,0.1); color:white; border:none; border-radius:5px; margin-bottom:15px;"></textarea>
            
            <button type="submit" class="btn-claim" style="width:100%; padding:15px;">Submit Post for Review</button>
        </form>
    </div>
</body>
</html>
