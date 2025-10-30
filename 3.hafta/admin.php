<?php
require_once 'check_auth.php';
require_role('admin');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <title>Admin Paneli</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body class="gold-bg">
  <div class="login-container" style="max-width:640px">
    <h2>Admin Paneli</h2>
    <p>Hoş geldin, <strong><?php echo htmlspecialchars($_SESSION['full_name']); ?></strong> (<?php echo htmlspecialchars($_SESSION['username']); ?>)</p>
    <p>Rolün: <b><?php echo htmlspecialchars($_SESSION['role']); ?></b></p>

    <div style="margin-top:20px;display:flex;gap:10px;flex-wrap:wrap;">
      <a href="change_password.php" style="background:gold;color:#000;padding:10px 14px;border-radius:8px;text-decoration:none;">Şifre Değiştir</a>
      <a href="change_username.php" style="background:gold;color:#000;padding:10px 14px;border-radius:8px;text-decoration:none;">Kullanıcı Adı Değiştir</a>
      <a href="logout.php" style="background:#ffdf00;color:#000;padding:10px 14px;border-radius:8px;text-decoration:none;">Çıkış Yap</a>
    </div>
  </div>
</body>
</html>
