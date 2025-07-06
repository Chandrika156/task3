<?php
require 'db.php';
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  if (!$username || !$password) {
    $errors[] = "All fields are required.";
  } else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    try {
      $stmt->execute([$username, $hash]);
      $_SESSION['user_id'] = $pdo->lastInsertId();
      header('Location: index.php');
    } catch (PDOException $e) {
      $errors[] = "Username already taken.";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Register</h2>
  <?php foreach ($errors as $e): ?>
    <div class="alert alert-danger"><?= $e ?></div>
  <?php endforeach; ?>
  <form method="POST">
    <input name="username" class="form-control mb-2" placeholder="Username" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
    <button class="btn btn-primary">Register</button>
    <a href="login.php" class="btn btn-link">Login</a>
  </form>
</div>
</body>
</html>
