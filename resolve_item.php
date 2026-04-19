<?php
session_start();
require 'db.php';

if (isset($_POST['item_id']) && isset($_SESSION['user_id'])) {
    $item_id = $_POST['item_id'];
    
    // Update Item status
    $stmt = $pdo->prepare("UPDATE items SET status = 'Resolved' WHERE item_id = ? AND user_id = ?");
    $stmt->execute([$item_id, $_SESSION['user_id']]);

    if ($stmt->rowCount() > 0) {
        // Reward the finder
        $reward = $pdo->prepare("UPDATE users SET reputation_score = reputation_score + 10 WHERE user_id = ?");
        $reward->execute([$_SESSION['user_id']]);
        echo "Item resolved and points awarded!";
    }
}
?>
