<?php
require_once 'check_auth.php'; require_role('admin');
require_once 'db.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id>0) {
  $st=$pdo->prepare("DELETE FROM members WHERE id=?");
  $st->execute([$id]);
}
header('Location: members.php');
