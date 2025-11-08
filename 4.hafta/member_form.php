<?php
require_once 'check_auth.php'; require_role('admin');
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$editing = $id>0;
$username=$full_name=$email=''; $status='aktif';

if ($editing) {
  $st=$pdo->prepare("SELECT * FROM members WHERE id=?");
  $st->execute([$id]); $row=$st->fetch();
  if(!$row){ header('Location: members.php'); exit; }
  $username=$row['username']; $full_name=$row['full_name']; $email=$row['email']; $status=$row['status'];
}

if($_SERVER['REQUEST_METHOD']==='POST'){
  $username=trim($_POST['username']??'');
  $full_name=trim($_POST['full_name']??'');
  $email=trim($_POST['email']??'');
  $status=$_POST['status']??'aktif';

  if($username==='' || $full_name===''){
    $err='Kullanıcı adı ve Ad Soyad zorunlu.';
  } else {
    if($editing){
      $st=$pdo->prepare("UPDATE members SET username=?, full_name=?, email=?, status=? WHERE id=?");
      $st->execute([$username,$full_name,$email,$status,$id]);
    } else {
      $st=$pdo->prepare("INSERT INTO members (username,full_name,email,status) VALUES (?,?,?,?)");
      $st->execute([$username,$full_name,$email,$status]);
    }
    header('Location: members.php'); exit;
  }
}
?>
<!DOCTYPE html><html lang="tr"><head>
<meta charset="UTF-8"><title><?php echo $editing?'Üye Düzenle':'Üye Ekle';?></title>
<link rel="stylesheet" href="style.css">
</head><body class="gold-bg">
  <div class="login-container" style="max-width:560px;text-align:left">
    <h2 style="color:gold"><?php echo $editing?'Üye Düzenle':'Üye Ekle';?></h2>
    <?php if(!empty($err)): ?><p style="color:#ffd;"><?php echo htmlspecialchars($err);?></p><?php endif; ?>
    <form method="post" class="login-form">
      <input type="text"   name="username"  placeholder="Kullanıcı Adı *" value="<?php echo htmlspecialchars($username); ?>" required>
      <input type="text"   name="full_name" placeholder="Ad Soyad *"      value="<?php echo htmlspecialchars($full_name); ?>" required>
      <input type="email"  name="email"     placeholder="E-posta"         value="<?php echo htmlspecialchars($email); ?>">
      <select name="status" style="width:100%;padding:10px;border-radius:8px;margin-bottom:15px;background:rgba(255,255,255,0.2);color:#fff;border:none">
        <?php foreach (['aktif','pasif','engelli'] as $s): ?>
          <option value="<?php echo $s; ?>" <?php if($status===$s) echo 'selected'; ?>>
            <?php echo ucfirst($s); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="submit"><?php echo $editing?'Güncelle':'Ekle';?></button>
    </form>
    <div style="margin-top:10px"><a class="btn" href="members.php">Geri</a></div>
  </div>
</body></html>
