<?php
require_once 'check_auth.php'; require_role('admin');
require_once 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$to = $_GET['to'] ?? 'aktif';
if (!in_array($to, ['aktif','pasif','engelli'], true)) $to='aktif';

if ($id>0){
  $st=$pdo->prepare("UPDATE members SET status=? WHERE id=?");
  $st->execute([$to,$id]);
}
header('Location: members.php');
