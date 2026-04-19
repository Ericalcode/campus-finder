<?php
session_start();
function e($text) { return htmlspecialchars($text); }
?>
<nav class="glass-card" style="margin-bottom:20px; padding:15px; display:flex; justify-content:space-between; align-items:center;">
    <a href="index.php" style="color:#e94560; text-decoration:none; font-weight:bold; font-size:1.2em;">Campus Finder</a>
    <div style="display:flex; gap:15px; align-items:center;">
        <a href="index.php" style="color:white; text-decoration:none; font-size:0.9em;">Feed</a>
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="admin.php" style="color:#f1c40f; text-decoration:none; font-size:0.9em;">Shield</a>
        <?php endif; ?>
        <a href="logout.php" style="color:#ff4757; text-decoration:none; font-size:0.9em; border:1px solid #ff4757; padding:5px 10px; border-radius:5px;">Logout</a>
    </div>
</nav>
