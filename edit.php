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

$stmt = $db->prepare('select * from posts where id=?');
if (!$stmt) {
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt->bind_param('i', $id);
$result = $stmt->execute();
if (!$result) {
  die($db->error);
}
$stmt->bind_result($id, $message, $member_id, $created);
$stmt->fetch();

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
  <div id="wrap">
    <div id="head">
      <h1>編集画面</h1>
    </div>
    <div id="content">
      <a href="logout.php">ログアウトする</a>
      <p>&laquo;<a href="index.php">一覧に戻る</p>
      <form action="update.php" method="post">
        <dl>
          <dt><?php echo h($name); ?>さん</dt>
          <dd>
            <input type="hidden" name="id" value="<?php echo h($id); ?>">
            <textarea name="message" cols="50" rows="5"><?php echo h($message); ?></textarea>
          </dd>
        </dl>
        <div>
          <p>
            <input type="submit" value="編集する">
          </p>
        </div>
      </form>
    </div> 
  </div>
</body>
</html>