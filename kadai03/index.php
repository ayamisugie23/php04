<?php
//ログイン確認
session_start();
require_once('funcs.php');
loginCheck();
// $postid = $_POST['id'];
$id = $_SESSION['id'];
// echo $_SESSION['id'];

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=want_book_data;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
// $stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :id ;");
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$result = "";
$viewuser = "";
if ($status == false) {
    sql_error($status);
} else {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //GETデータ送信リンク作成
        // <a>で囲う。
        $viewuser .= '<a class = "headermenu" href="detailid.php?id=' . $_SESSION["id"] . '">';
        $viewuser .= 'ようこそ' . $_SESSION["name"]. 'さん';
        $viewuser .= '</a>';       
    }
    $kanri_flg = $result["kanri_flg"];
    // echo $result['id'];
    // echo $kanri_flg;
    if($kanri_flg = 1){
      $viewlist =  '<a class="navbar-brand" href="select.php">';
      // loginId();     
    }else{
      $viewlist =  '<a class="navbar-brand" href="select_G.php">'; 
    }

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <style>.headermenu{padding: 10px; color:white;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><?= $viewlist ?>買う本リスト</a>
      <div class="navbar-header"><?= $viewuser ?></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>買いたい本を登録！</legend>
     <label>タイトル<input type="text" name="title"></label><br>
     <label>著者<input type="text" name="writer"></label><br>
     <label>出版社<input type="text" name="publisher"></label><br>
     <label>価格（税抜）<input type="text" name="price"></label><br>
     <label>Amazon URL<input type="text" name="amazon"></label><br>
     <label>メモ<textArea name="memo" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
