<?php
require 'db.php';
$check = $pdo->query('SELECT 1')->fetchColumn();
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>CAT2 App</title>
<style>body{font-family:sans-serif;background:#eef2f9;display:flex;min-height:100vh;align-items:center;justify-content:center;margin:0}
.card{background:#fff;padding:40px;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,.08);text-align:center;max-width:360px}
a.btn{display:block;margin:10px 0;padding:12px;background:#2f5bd1;color:#fff;text-decoration:none;border-radius:8px}
.ok{color:#1d7a4d;font-size:14px}</style></head>
<body><div class="card">
  <h2>CAT2 Web Application</h2>
  <p class="ok">&#10003; Connected to CAT2 (test query returned <?= $check ?>)</p>
  <a class="btn" href="register.php">Sign up</a>
  <a class="btn" href="login.php">Log in</a>
</div></body></html>
