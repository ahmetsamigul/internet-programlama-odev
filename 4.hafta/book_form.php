<?php
require_once 'check_auth.php'; require_role('admin');
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$editing = $id > 0;
$title = $author = $isbn = ''; $year = '';

if ($editing) {
  $st = $pdo->prepare("SELECT * FROM books WHERE id=?");
  $st->execute([$id]);
  $row = $st->fetch();
  if (!$row) { header('Location: books.php'); exit; }
  $title=$row['title']; $author=$row['author']; $isbn=$row['isbn']; $year=$row['year'];
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $title = trim($_POST['title'] ?? '');
  $author= trim($_POST['author'] ?? '');
  $isbn  = trim($_POST['isbn'] ?? '');
  $year  = $_POST['year'] !== '' ? (int)$_POST['year'] : null;

  if ($title==='' || $author==='') {
    $err = 'Başlık ve Yazar zorunlu.';
  } else {
    if ($editing) {
      $st = $pdo->prepare("UPDATE books SET title=?, author=?, isbn=?, year=? WHERE id=?");
      $st->execute([$title,$author,$isbn,$year,$id]);
    } else {
      $st = $pdo->prepare("INSERT INTO books (title,author,isbn,year) VALUES (?,?,?,?)");
      $st->execute([$title,$author,$isbn,$year]);
    }
    header('Location: books.php'); exit;
  }
}
?>
<!DOCTYPE html><html lang="tr"><head>
<meta charset="UTF-8"><title><?php echo $editing?'Kitap Düzenle':'Kitap Ekle';?></title>
<link rel="stylesheet" href="style.css">
</head><body class="gold-bg">
  <div class="login-container" style="max-width:560px;text-align:left">
    <h2 style="color:gold"><?php echo $editing?'Kitap Düzenle':'Kitap Ekle';?></h2>
    <?php if(!empty($err)): ?><p style="color:#ffd;"><?php echo htmlspecialchars($err);?></p><?php endif; ?>
    <form method="post" class="login-form" style="text-align:left">
      <input type="text" name="title"  placeholder="Başlık *" value="<?php echo htmlspecialchars($title); ?>" required>
      <input type="text" name="author" placeholder="Yazar *"  value="<?php echo htmlspecialchars($author); ?>" required>
      <input type="text" name="isbn"   placeholder="ISBN"     value="<?php echo htmlspecialchars($isbn); ?>">
      <input type="number" name="year" placeholder="Yıl"      value="<?php echo htmlspecialchars($year); ?>">
      <button type="submit"><?php echo $editing?'Güncelle':'Ekle';?></button>
    </form>
    <div style="margin-top:10px"><a class="btn" href="books.php">Geri</a></div>
  </div>
</body></html>
