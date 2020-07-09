<?php
session_start();
include('functions.php');
// check_session_id();
$output = "";
$number = $_SESSION["q_number"];
$number = (int) $number;

for ($i = 0; $i < $number; $i++) {
  $j = $i + 1;
  $output .= "<div>設問${j}：<input type=\"text\" name=\"Q${j}\"></div>";
}
$enquete_name = $_SESSION["enquete_name"];
$deadline = $_SESSION["deadline"];
$_SESSION["q_number"] = $number;
$_SESSION["enquete_name"] = $enquete_name;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート作成画面</title>
</head>

<body>
  <form action="create.php" method="POST">
    <fieldset>
      <legend>アンケート作成画面</legend>
      <a href="read_admin.php">アンケートリストへ</a>
      <a href="logout.php">logout</a>
      <div>
        セミナー名：
        <?= $enquete_name ?>
      </div>
      <div>
        期限：
        <?= $deadline ?>
      </div>
      <div>
        <!-- 設定した設問の数だけインプットテキストが入ったセッションがくる -->
        <?= $output ?>
      </div>
      <div>
        <button>作成</button>
      </div>
    </fieldset>
  </form>

</body>

</html>