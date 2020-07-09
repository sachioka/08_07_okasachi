<?php
session_start();
include('functions.php');
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート登録画面</title>
</head>

<body>
  <form action="create_list.php" method="POST">
    <fieldset>
      <legend>アンケート登録画面</legend>
      <a href="read_admin.php">アンケート一覧へ</a>
      <a href="logout.php">logout</a>
      <div>
        アンケート名: <input type="text" name="enquete_name">
      </div>
      <div>
        期限: <input type="date" name="deadline">
      </div>
      <div>
        設問数: <select class="" name="q_number">
          <option value='3'>3問</option>
          <option value='4'>4問</option>
          <option value='5'>5問</option>
          <option value='6'>6問</option>
        </select>

      </div>
      <div>
        <button>作成開始</button>
      </div>
    </fieldset>
  </form>

</body>

</html>