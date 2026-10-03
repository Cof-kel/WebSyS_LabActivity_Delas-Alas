<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: read.php?msg=Task deleted successfully");
    exit;
} else {
    header("Location: read.php");
    exit;
}
?>