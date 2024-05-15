<?php
session_start();
require('../library.php');

if (isset($_GET['action']) && $_GET['action'] === 'rewrite' && isset($_SESSION['form'])) {
  $form = $_SESSION['form'];
} else {
  $form = [
  'name' => '',
  'email' => '',
  'password' => ''
];
}
$error = [];

/* フォームの内容をチェック */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $form['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
  if ($form['name'] === '') {
    $error['name'] = 'blank';
  }

  $form['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  if ($form['email'] === '') {
    $error['email'] = 'blank';
  } else {
    $db = dbconnect();
    $stmt = $db->prepare('select count(*) from members where email=?');
    if (!$stmt) {
      die($db->error);
    }
    $stmt->bind_param('s', $form['email']);
    $success = $stmt->execute();
    if (!$success) {
      die($db->error);
    }
    $stmt->bind_result($cnt);
    $stmt->fetch();

    if ($cnt > 0) {
      $error['email'] = 'duplicate';
    }
  }

  $form['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  if ($form['password'] === '') {
    $error['password'] = 'blank';
  } else if (strlen($form['password']) < 4) {
    $error['password'] = 'length';
  }

  if (empty($error)) {
    $_SESSION['form'] = $form;
  

  header('Location: check.php');
  exit();
}
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員登録</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div id="wrap">
    <div id="head">
      <h1>会員登録</h1>
    </div>
  <div id="content">
    <form action="" method="post">
      <dl>

        <dt>お名前<span class="required">必須</span></dt>
          <dd>
            <input type="text" name="name" size="35" maxlength="255" value="<?php echo h($form['name']); ?>"/>
            <?php if (isset($error['name']) && $error['name'] === 'blank') : ?>
              <p class="error">*お名前を入力してください</p>
            <?php endif; ?>
          </dd>

        <dt>メールアドレス<span class="required">必須</span></dt>
          <dd>
            <input type="text" name="email" size="35" maxlength="255" value="<?php echo h($form['email']); ?>"/>
            <?php if (isset($error['email']) && $error['email'] === 'blank') : ?>
              <p class="error">*メールアドレスを入力してください</p>
            <?php endif; ?>
            <?php if (isset($error['email']) && $error['email'] === 'duplicate') : ?>
              <p class="error">*指定されたメールアドレスはすでに登録されています</p>
            <?php endif; ?>
          </dd>

        <dt>パスワード<span class="required">必須</span></dt>
          <dd>
            <input type="text" name="password" size="35" maxlength="255" value="<?php echo h($form['password']); ?>"/>
            <?php if (isset($error['password']) && $error['password'] === 'blank') : ?>
              <p class="error">*パスワードを入力してください</p>
            <?php endif; ?>
            <?php if (isset($error['password']) && $error['password'] === 'length') : ?>
              <p class="error">*パスワードは4文字以上で入力してください</p>
            <?php endif; ?>
          </dd>

      </dl>
      <p><input type="submit" style="font-size: 18px" value="入力内容を確認する"/></p>
    </form>
  </div>
  </div>
</body>
</html>