<?php
require 'db.php';
$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($fullname && $email && $username && $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare(
              "INSERT INTO users (fullname,email,username,password)
               VALUES (:f,:e,:u,:p)");
            $stmt->execute([':f'=>$fullname, ':e'=>$email,
                           ':u'=>$username, ':p'=>$hash]);
            $success = "Account created for $username. You can now log in.";
        } catch (PDOException $ex) {
            $error = "Could not register: " . $ex->getMessage();
        }
    } else { $error = "All fields are required."; }
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Sign up</title>
<style>body{font-family:sans-serif;background:#eef2f9;display:flex;min-height:100vh;align-items:center;justify-content:center;margin:0}
.card{background:#fff;padding:34px;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,.08);width:340px}
h2{margin-top:0}input{width:100%;padding:10px;margin:7px 0;border:1px solid #cdd4e0;border-radius:8px;box-sizing:border-box}
button{width:100%;padding:11px;background:#2f5bd1;color:#fff;border:0;border-radius:8px;font-size:15px;cursor:pointer}
.msg{padding:9px;border-radius:8px;margin-bottom:8px;font-size:14px}
.err{background:#fde8e8;color:#9b1c1c}.ok{background:#e5f5ec;color:#16603c}
a{color:#2f5bd1}</style></head><body>
<form class="card" method="post">
  <h2>Create account</h2>
  <?php if($error):?><div class="msg err"><?=htmlspecialchars($error)?></div><?php endif;?>
  <?php if($success):?><div class="msg ok"><?=htmlspecialchars($success)?></div><?php endif;?>
  <input name="fullname" placeholder="Full name" required>
  <input name="email" type="email" placeholder="Email" required>
  <input name="username" placeholder="Username" required>
  <input name="password" type="password" placeholder="Password" required>
  <button>Sign up</button>
  <p style="text-align:center;font-size:14px">Have an account? <a href="login.php">Log in</a></p>
</form></body></html>
