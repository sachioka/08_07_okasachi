<?php
session_start();
include("functions.php");
// check_session_id();
// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['enquete_name']) || $_POST['enquete_name'] == '' ||
  !isset($_POST['q_number']) || $_POST['q_number'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる
$enquete_name = $_POST['enquete_name'];
$deadline = $_POST['deadline'];
$q_number = $_POST['q_number'];

// DB接続
$pdo = connect_to_db();

$sql = 'INSERT INTO `Q_list`(`id`, `enquete_name`, `q_number`, `ans_count`, `deadline`, `is_delete`) VALUES (NULL,:enquete_name,:q_number,NULL,:deadline,0)';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':enquete_name', $enquete_name, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':q_number', $q_number, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 
  $_SESSION = array();
  $_SESSION["enquete_name"] = $enquete_name;
  $_SESSION["deadline"] = $deadline;
  $_SESSION["q_number"] = $q_number;
  
  // 入力した設問の数だけインプットテキストを持ってくる
  // 種類の変更は後々・・・
  header("Location:input.php");
  exit();
}
