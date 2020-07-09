<?php
session_start();
include("functions.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM Q_list';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  if ($result == []) {
    $output .= "<tr>アンケートはありません。</tr>";
  } else {
    // exit();
    $output .= "<table>";
    $output .=  "<thead>";
    $output .=  "<tr>";
    $output .=  "<th>NO.</th>";
    $output .= "<th>アンケート名</th>";
    $output .= "<th>質問数</th>";
    $output .=  "<th>回答者数</th>";
    $output .=  "<th>回答</th>";
    $output .=  "</tr>";
    $output .= "</thead>";
    $output .=  "<tbody>";

    // `.=`は後ろに文字列を追加する，の意味
    foreach ($result as $record) {
      $output .= "<tr>";
      $output .= "<td>{$record["id"]}</td>";
      $output .= "<td>{$record["enquete_name"]}</td>";
      $output .= "<td>{$record["q_number"]}</td>";
      $output .= "<td>{$record["ans_count"]}</td>";
      // edit deleteリンクを追加
      $output .= "<td><a href='input.php?id={$record["id"]}'>回答する</a></td>";
      // ↑↑↑に回答するアンケートの
      $output .= "</tr>";
    }
    $output .= "</tbody>";
    $output .= "</table>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
  $admin_judge = $_SESSION["admin"];
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>アンケートリスト</legend>
    <a href="logout.php">logout</a>
    <div><?= $admin_judge ?></div>
    <table>
      <thead>
        <tr>
          <th>deadline</th>
          <th>todo</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>