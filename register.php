<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー登録画面</title>
</head>

<body>
  <form action="register_act.php" method="POST">
    <fieldset>
      <legend>アンケートユーザー登録画面</legend>
      <div>
        ユーザー名: <input type="text" name="username">
      </div>
      <div>
        パスワード: <input type="text" name="password">
      </div>
      <div>
        管理者として登録する:<input type="checkbox" name="admin" value="1">
      </div>
      <div>
        <button>登録</button>
      </div>
      <a href="login.php">ログインへ</a>
    </fieldset>
  </form>

</body>

</html>