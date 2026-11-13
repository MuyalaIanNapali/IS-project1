<?php
session_start();
require 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :u");
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['fullname'];
        header("Location: welcome.php");
        exit;
    }
    $error = "Invalid username or password.";
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Log in</title>
<style>body{font-family:sans-serif;background:#eef2f9;display:flex;min-height:100vh;align-items:center;justify-content:center;margin:0}
.card{background:#fff;padding:34px;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,.08);width:320px}
h2{margin-top:0}input{width:100%;padding:10px;margin:7px 0;border:1px solid #cdd4e0;border-radius:8px;box-sizing:border-box}
button{width:100%;padding:11px;background:#1d7a4d;color:#fff;border:0;border-radius:8px;font-size:15px;cursor:pointer}
.err{background:#fde8e8;color:#9b1c1c;padding:9px;border-radius:8px;margin-bottom:8px;font-size:14px}
a{color:#2f5bd1}</style></head><body>
<form class="card" method="post">
  <h2>Log in</h2>
  <?php if($error):?><div class="err"><?=htmlspecialchars($error)?></div><?php endif;?>
  <input name="username" placeholder="Username" required>
  <input name="password" type="password" placeholder="Password" required>
  <button>Log in</button>
  <p style="text-align:center;font-size:14px">New here? <a href="register.php">Sign up</a></p>
</form></body></html>
