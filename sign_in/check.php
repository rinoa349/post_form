<?php
session_start();
require('../library.php');

// もし、$_SESSION['form']に値が入っていたら
if (isset($_SESSION['form'])) {
  // $formに格納する
  $form = $_SESSION['form'];
} else {
  header('Location: index.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $db = dbconnect();
  $stmt = $db->prepare('insert into members (name, email, password) VALUES (?, ?, ?)');
  if (!$stmt) {
    die($db->error);
  }
  $password = password_hash($form['password'], PASSWORD_DEFAULT);
  $stmt->bind_param('sss', $form['name'], $form['email'], $password);
  $success = $stmt->execute();
  if (!$success) {
    die($db->error);
  }

  //セッション内容を削除
  unset($_SESSION['form']);
  header('Location: thanks.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員登録</title>

  <link rel="stylesheet" href="../style.css" />
</head>
<body>
  <div id="wrap">
    <div id="head">
      <h1>会員登録</h1>
    </div>

    <div id="content">
      <p>記入した内容を確認して、「登録する」ボタンをクリックしてください。</p>
      <form action="" method="post">
        <dl>
          <dt>お名前</dt>
          <dd><?php echo h($form['name']); ?></dd>

          <dt>メールアドレス</dt>
          <dd><?php echo h($form['email']); ?></dd>

          <dt>パスワード</dt>
          <dd>[ 表示されません ]</dd>
        </dl>
        <div><a href="index.php?action=rewrite">&laquo;書き直す</a> | <input type="submit" style="font-size: 18px" value="登録する" /></div>
      </form>
    </div>
  </div>
</body>
</html>