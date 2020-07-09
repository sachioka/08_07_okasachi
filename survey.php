<?php
// 送信データのチェック
// var_dump($_GET);
// exit();

// 関数ファイルの読み込み
session_start();
include("functions.php");
check_session_id();
$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM todo_table WHERE id=:id';
//↑↑に新しく作ったアンケートのテーブルを持ってくる
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート回答画面</title>
  <!-- タイトル名も変えれたらいいな -->
</head>

<body>
  <form action="addans.php" method="POST">
    <fieldset>
      <legend>アンケート回答画面</legend>
      <a href="read.php">一覧へ戻る</a>
      <div>
        todo: <input type="text" name="todo" value="<?= $record["todo"] ?>">
      </div>
      <div>
        deadline: <input type="date" name="deadline" value="<?= $record["deadline"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
    </fieldset>
  </form>

</body>

</html>