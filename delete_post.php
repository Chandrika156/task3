<?php
require 'auth.php';
require_login();

if (!isset($_GET['id'])) {
    die("Missing post ID.");
}

$id = $_GET['id'];

// Optional: Ensure user owns the post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found or you don't have permission.");
}

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;

