<?php
session_start();
require('../library.php');

if (isset($_SESSION['id']) && isset($_SESSION['name'])) {
  $id = $_SESSION['id'];
  $name = $_SESSION['name'];
} else {
  header('Location: login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿掲示板</title>
</head>
<body>
  <div id=wrap>
    <div id="head">
      <h1>投稿掲示板</h1>
    </div>
    <div id="content">
      <div><a href="logout.php">ログアウト</a></div>
      <form action="" method="post">
        <dl>
          <dt>()さん、書き込みをどうぞ</dt>
          <dd>
            <textarea name="message" cols="50" rows="5"></textarea>
          </dd>
        </dl>
        <div>
          <p>
            <input type="submit" value="投稿する">
          </p>
        </div>
      </form>

    </div>
  </div>
</body>
</html>