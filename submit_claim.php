<?php
session_start();
require 'db.php';
// Add this inside submit_claim.php before processing
if (!isset($_SESSION['last_claim_attempt'])) {
    $_SESSION['last_claim_attempt'] = time();
    $_SESSION['attempts'] = 1;
} else {
    if (time() - $_SESSION['last_claim_attempt'] < 60) {
        if ($_SESSION['attempts'] >= 3) {
            die("Too many attempts. Wait 1 minute.");
        }
        $_SESSION['attempts']++;
    } else {
        $_SESSION['last_claim_attempt'] = time();
        $_SESSION['attempts'] = 1;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $item_id = $_POST['item_id'];
    $answer = htmlspecialchars($_POST['answer']);
    $claimer_id = $_SESSION['user_id'];

    $pdo->beginTransaction();
    try {
        // Log the claim
        $stmt = $pdo->prepare("INSERT INTO claims (item_id, claimer_id, submitted_answer) VALUES (?, ?, ?)");
        $stmt->execute([$item_id, $claimer_id, $answer]);

        // Mark item as Pending
        $update = $pdo->prepare("UPDATE items SET status = 'Pending' WHERE item_id = ?");
        $update->execute([$item_id]);

        $pdo->commit();
        echo "Claim submitted for review.";
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error processing claim.";
    }
}
?>
