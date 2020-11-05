

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>管理ユーザー登録</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<!-- <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">ブックマークデータ一覧</a></div>
    </div>
  </nav>
</header> -->
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insertid.php">
  <div>
   <fieldset>
    <legend>管理ユーザー登録</legend>
      <label>名前：<input type="text" name="name" value="<?=$result['name']?>"></label><br>
      <label>ID：<input type="text" name="lid" value="<?=$result['lid']?>"></label><br>
      <label>PASSWORD：<input type="text" name="lpw" value="<?=$result['lpw']?>"></label><br>
      <label>管理者チェック（管理者：1）：<input type="text" name="kanri_flg" value="<?=$result['kanri_flg']?>"></label><br>
      <label>在籍チェック（在籍者：1）：<input type="text" name="life_flg" value="<?=$result['life_flg']?>"></label><br>
     <!-- <label>名前：<input type="text" name="book_name"></label><br>
     <label>URL：<input type="text" name="book_URL"></label><br>
     <label><textArea name="book_comment" rows="4" cols="40"></textArea></label><br> -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<a href="selectid.php">ユーザーの一覧へ</a>

</body>
</html>
