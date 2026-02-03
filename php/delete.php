<?php
include '../includes/config.php';

$sql = "DELETE FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $_SESSION['user']['id']
]);

session_destroy();
header("Location: index.php");
?>