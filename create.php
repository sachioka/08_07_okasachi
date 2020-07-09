<?php
session_start();
include("functions.php");
check_session_id();
// 送信確認
var_dump($_POST);
exit();

$number = $_SESSION['q_number'];

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if ($number == 3) {
  if (
    !isset($_POST['Q1']) || $_POST['Q1'] == '' ||
    !isset($_POST['Q2']) || $_POST['Q2'] == '' ||
    !isset($_POST['Q3']) || $_POST['Q3'] == ''
  ) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
  } else {
    $Q1 = $_SESSION["Q1"];
    $Q2 = $_SESSION["Q2"];
    $Q3 = $_SESSION["Q3"];
  }
} else if ($number == 4) {
  if (
    !isset($_POST['Q1']) || $_POST['Q1'] == '' ||
    !isset($_POST['Q2']) || $_POST['Q2'] == '' ||
    !isset($_POST['Q3']) || $_POST['Q3'] == '' ||
    !isset($_POST['Q4']) || $_POST['Q4'] == ''
  ) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
  } else {
    $Q1 = $_SESSION["Q1"];
    $Q2 = $_SESSION["Q2"];
    $Q3 = $_SESSION["Q3"];
    $Q4 = $_SESSION["Q4"];

  }
} else if ($number == 5) {
  if (
    !isset($_POST['Q1']) || $_POST['Q1'] == '' ||
    !isset($_POST['Q2']) || $_POST['Q2'] == '' ||
    !isset($_POST['Q3']) || $_POST['Q3'] == '' ||
    !isset($_POST['Q4']) || $_POST['Q4'] == '' ||
    !isset($_POST['Q5']) || $_POST['Q5'] == ''
  ) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
  }else{
    $Q1 = $_SESSION["Q1"];
    $Q2 = $_SESSION["Q2"];
    $Q3 = $_SESSION["Q3"];
    $Q4 = $_SESSION["Q4"];
    $Q5 = $_SESSION["Q5"];
  }
} else if ($number == 6) {
  if (
    !isset($_POST['Q1']) || $_POST['Q1'] == '' ||
    !isset($_POST['Q2']) || $_POST['Q2'] == '' ||
    !isset($_POST['Q3']) || $_POST['Q3'] == '' ||
    !isset($_POST['Q4']) || $_POST['Q4'] == '' ||
    !isset($_POST['Q5']) || $_POST['Q5'] == '' ||
    !isset($_POST['Q6']) || $_POST['Q6'] == ''

  ) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
    exit();
  } else {
    $Q1 = $_SESSION["Q1"];
    $Q2 = $_SESSION["Q2"];
    $Q3 = $_SESSION["Q3"];
    $Q4 = $_SESSION["Q4"];
    $Q5 = $_SESSION["Q5"];
    $Q6 = $_SESSION["Q6"];
  }
}
$enquete_name = $_SESSION["enquete_name"];


// DB接続
$pdo = connect_to_db();

$sql = 'CREATE TABLE $enquete_name (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(20),
	age INT(11),
	registry_datetime DATETIME
) engine=innodb default charset=utf8';



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
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:read_admin.php");
  exit();
}
