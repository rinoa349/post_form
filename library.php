<?php

/* htmlspecialcharsの短縮化 */
function h($value) {
  return htmlspecialchars($value, ENT_QUOTES);
}

/* データベースへの接続 */
function dbconnect() {
  $db = new mysqli('localhost', 'root', 'root', 'post_form');
  if (!$db) {
    ($db->error);
  }
  return $db;
}

?>