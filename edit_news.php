<?php
require "header.php";
require "db.php";
if($_SESSION["role"] !== "admin") exit("Access Denied");

$id = $_GET["id"];
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $pdo->prepare("UPDATE news SET title=?, content=? WHERE news_id=?")->execute([$_POST["t"], $_POST["c"], $id]);
    header("Location: admin.php");
}
$n = $pdo->query("SELECT * FROM news WHERE news_id=$id")->fetch();
?>
<body class="container"><link rel="stylesheet" href="style.css">
<form method="POST" class="glass-card">
    <input name="t" value="<?= $n["title"] ?>" style="width:100