<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Welcome</title>
<style>body{font-family:sans-serif;background:#eef2f9;display:flex;min-height:100vh;align-items:center;justify-content:center;margin:0}
.card{background:#fff;padding:40px;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,.08);text-align:center;max-width:380px}
a.btn{display:inline-block;margin:8px 5px;padding:10px 16px;background:#2f5bd1;color:#fff;text-decoration:none;border-radius:8px}
a.out{background:#9b1c1c}</style></head><body><div class="card">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?> &#128075;</h2>
  <p>You are logged in as <b><?= htmlspecialchars($_SESSION['username']) ?></b>.</p>
  <a class="btn" href="feedback.php">Give feedback</a>
  <a class="btn out" href="logout.php">Log out</a>
</div></body></html>
