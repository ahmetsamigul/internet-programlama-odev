<?php
require_once 'check_auth.php'; require_role('admin');
require_once 'db.php';

// Liste
$stmt = $pdo->query("SELECT * FROM books ORDER BY id DESC");
$books = $stmt->fetchAll();
?>
<!DOCTYPE html><html lang="tr"><head>
<meta charset="UTF-8"><title>Kitaplar</title>
<link rel="stylesheet" href="style.css">
</head><body class="gold-bg">
  <div class="login-container" style="max-width:900px;text-align:left">
    <h2 style="color:gold">Kitaplar</h2>
    <div style="margin:10px 0 20px">
      <a class="btn" href="book_form.php">+ Kitap Ekle</a>
      <a class="btn" href="admin.php">Admin Paneli</a>
    </div>

    <table style="width:100%;border-collapse:collapse;color:#fff">
      <thead>
        <tr>
          <th style="text-align:left;border-bottom:1px solid rgba(255,255,255,.2);padding:8px">ID</th>
          <th style="text-align:left;border-bottom:1px solid rgba(255,255,255,.2);padding:8px">Başlık</th>
          <th style="text-align:left;border-bottom:1px solid rgba(255,255,255,.2);padding:8px">Yazar</th>
          <th style="text-align:left;border-bottom:1px solid rgba(255,255,255,.2);padding:8px">ISBN</th>
          <th style="text-align:left;border-bottom:1px solid rgba(255,255,255,.2);padding:8px">Yıl</th>
          <th style="text-align:left;border-bottom:1px solid rgba(255,255,255,.2);padding:8px">İşlem</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $b): ?>
        <tr>
          <td style="padding:8px"><?php echo $b['id']; ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($b['title']); ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($b['author']); ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($b['isbn']); ?></td>
          <td style="padding:8px"><?php echo htmlspecialchars($b['year']); ?></td>
          <td style="padding:8px">
            <a class="btn" href="book_form.php?id=<?php echo $b['id']; ?>">Düzenle</a>
            <a class="btn" href="book_delete.php?id=<?php echo $b['id']; ?>"
               onclick="return confirm('Silinsin mi?')">Sil</a>
          </td>
        </tr>
        <?php endforeach; if(!$books): ?>
          <tr><td colspan="6" style="padding:8px">Henüz kayıt yok.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body></html>
