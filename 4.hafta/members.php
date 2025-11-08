<?php
require_once 'check_auth.php'; require_role('admin');
require_once 'db.php';

$st = $pdo->query("SELECT * FROM members ORDER BY id DESC");
$rows = $st->fetchAll();
?>
<!DOCTYPE html><html lang="tr"><head>
<meta charset="UTF-8"><title>Üyeler</title>
<link rel="stylesheet" href="style.css">
</head><body class="gold-bg">
  <div class="login-container" style="max-width:1000px;text-align:left">
    <h2 style="color:gold">Üyeler</h2>
    <div style="margin:10px 0 20px">
      <a class="btn" href="member_form.php">+ Üye Ekle</a>
      <a class="btn" href="admin.php">Admin Paneli</a>
    </div>

    <table style="width:100%;border-collapse:collapse;color:#fff">
      <thead>
        <tr>
          <th style="text-align:left;padding:8px;border-bottom:1px solid rgba(255,255,255,.2)">ID</th>
          <th style="text-align:left;padding:8px;border-bottom:1px solid rgba(255,255,255,.2)">Kullanıcı Adı</th>
          <th style="text-align:left;padding:8px;border-bottom:1px solid rgba(255,255,255,.2)">Ad Soyad</th>
          <th style="text-align:left;padding:8px;border-bottom:1px solid rgba(255,255,255,.2)">Email</th>
          <th style="text-align:left;padding:8px;border-bottom:1px solid rgba(255,255,255,.2)">Durum</th>
          <th style="text-align:left;padding:8px;border-bottom:1px solid rgba(255,255,255,.2)">İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($rows as $r): ?>
        <tr>
          <td style="padding:8px"><?php echo $r['id']; ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($r['username']); ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($r['full_name']); ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($r['email']); ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($r['status']); ?></td>
          <td style="padding:8px;display:flex;gap:6px;flex-wrap:wrap">
            <a class="btn" href="member_form.php?id=<?php echo $r['id']; ?>">Düzenle</a>
            <a class="btn" href="member_toggle_status.php?id=<?php echo $r['id']; ?>&to=<?php
               echo $r['status']==='aktif' ? 'pasif' : 'aktif'; ?>">
               <?php echo $r['status']==='aktif' ? 'Pasifleştir' : 'Aktifleştir'; ?>
            </a>
            <a class="btn" href="member_toggle_status.php?id=<?php echo $r['id']; ?>&to=engelli">Engelle</a>
            <a class="btn" href="member_delete.php?id=<?php echo $r['id']; ?>"
               onclick="return confirm('Üyeyi silmek istiyor musun?')">Sil</a>
          </td>
        </tr>
        <?php endforeach; if(!$rows): ?>
          <tr><td colspan="6" style="padding:8px">Henüz üye yok.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body></html>
