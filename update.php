<?php
session_start();
require('library.php');

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
} else {
  header('Location: login.php');
  exit();
}

$db = dbconnect();

if (!empty($_POST)) {
  if ($_POST['message'] !== '') {
    $stmt = $db->prepare('update posts set message=?, created=? where id=?');
    if (!$stmt) {
      die($db->error);
    }
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $stmt->bind_param('sii', $message, $created, $id);

    $success = $stmt->execute();
    if (!$success) {
      die($db->error);
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>投稿掲示板</title>
</head>
<body>
  <div id="wrap">
    <div id="head">
      <h1>編集完了画面</h1>
    </div>
    <div id="content">
      <p>編集が完了しました。</p>
      <p><a href="index.php">&laquo;一覧に戻る</p>
    </div>
  </div>
</body>
</html>