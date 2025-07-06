<?php $user = current_user(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top px-4">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-primary" href="index.php">My Blog</a>
    <div class="ms-auto">
      <?php if ($user): ?>
        <span class="me-3">Hello, <?= htmlspecialchars($user['username']) ?></span>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
