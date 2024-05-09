<?php

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css"/>
  <title>ログイン画面</title>
</head>
<body>
  <div id="wrap">
    <div id="head">
      <h1>ログイン画面</h1>
    </div>
    <div id="content">
      <div id="lead">
        <p>* メールアドレスとパスワードを入力してログインしてください。</p>
        <p>* 入会手続きがまだの方はコチラからどうぞ。</p>
        <p>&raquo;<a href="sign_in/">入会手続きをする</a></p>
      </div>
      <form action="" method="post">
        <dl>
          <dt>メールアドレス</dt>
          <dd>
            <input type="text" name="email" size="35" maxlength="255" value="" />
            <p class="error">* メールアドレスとパスワードをご記入ください</p>
            <p class="error">* ログインに失敗しました。正しくご記入ください。</p>
          </dd>
          <dt>パスワード</dt>
          <dd>
            <input type="password" name="password" size="35" maxlength="255" value="" />
          </dd>
        </dl>
        <div>
          <input type="submit" value="ログインする">
        </div>
      </form>
    </div>
  </div>
</body>
</html>