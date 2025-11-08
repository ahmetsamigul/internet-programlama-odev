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

    <div style="margin-top:20px;display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
      <a href="change_password.php" class="btn">Şifre Değiştir</a>
      <a href="change_username.php" class="btn">Kullanıcı Adı Değiştir</a>
      <a href="logout.php" class="btn">Çıkış Yap</a>
    </div>

    <div style="margin-top:20px;display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
      <a href="books.php" class="btn">Kitaplar</a>
      <a href="members.php" class="btn">Üyeler</a>
    </div>

  </div>
</body>
</html>
