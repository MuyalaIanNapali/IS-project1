<?php
session_start();
require 'db.php';
$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name && $email && $message) {
        $stmt = $pdo->prepare(
          "INSERT INTO feedback (name,email,subject,message)
           VALUES (:n,:e,:s,:m)");
        $stmt->execute([':n'=>$name, ':e'=>$email,
                       ':s'=>$subject, ':m'=>$message]);
        $success = "Feedback submitted — thank you!";
    } else { $error = "Name, email and message are required."; }
}


$rows = $pdo->query("SELECT * FROM feedback ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Feedback</title>
<style>body{font-family:sans-serif;background:#eef2f9;margin:0;padding:30px}
.wrap{max-width:720px;margin:0 auto}
.card{background:#fff;padding:26px;border-radius:14px;box-shadow:0 8px 30px rgba(0,0,0,.08);margin-bottom:22px}
input,textarea{width:100%;padding:10px;margin:6px 0;border:1px solid #cdd4e0;border-radius:8px;box-sizing:border-box}
button{padding:11px 20px;background:#2f5bd1;color:#fff;border:0;border-radius:8px;cursor:pointer}
table{width:100%;border-collapse:collapse;margin-top:6px}th,td{text-align:left;padding:8px;border-bottom:1px solid #e3e7ee;font-size:14px}
th{background:#f3f6fc}.ok{background:#e5f5ec;color:#16603c;padding:9px;border-radius:8px;margin-bottom:8px}
.err{background:#fde8e8;color:#9b1c1c;padding:9px;border-radius:8px;margin-bottom:8px}a{color:#2f5bd1}</style></head><body><div class="wrap">
  <div class="card">
    <h2>Leave feedback</h2>
    <?php if($error):?><div class="err"><?=htmlspecialchars($error)?></div><?php endif;?>
    <?php if($success):?><div class="ok"><?=htmlspecialchars($success)?></div><?php endif;?>
    <form method="post">
      <input name="name" placeholder="Your name" required>
      <input name="email" type="email" placeholder="Email" required>
      <input name="subject" placeholder="Subject">
      <textarea name="message" rows="3" placeholder="Message" required></textarea>
      <button>Submit</button>
    </form>
  </div>
  <div class="card">
    <h3>Submitted feedback (<?= count($rows) ?>)</h3>
    <table><tr><th>ID</th><th>Name</th><th>Subject</th><th>Message</th><th>When</th></tr>
      <?php foreach($rows as $r):?>
      <tr><td><?=$r['id']?></td><td><?=htmlspecialchars($r['name'])?></td>
          <td><?=htmlspecialchars($r['subject'])?></td><td><?=htmlspecialchars($r['message'])?></td>
          <td><?=$r['created_at']?></td></tr>
      <?php endforeach;?>
    </table>
    <p><a href="welcome.php">&larr; Back</a></p>
  </div>
</div></body></html>
