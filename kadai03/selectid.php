<?php
session_start();
require_once('funcs.php');
loginCheck();
// $postid = $_POST['id'];
$id = $_SESSION['id'];
// echo $_SESSION['id'];

//1. DB接続します
// require_once('funcs.php');
$pdo=db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  // fecthでデータを抽出
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view.='<a href="detailid.php?id='.$result['id'].'">';
    $view .= $result['name'].' '.$result['lid'];
    $view .='</a>';
    $view.='<a href="deleteid.php?id='.$result['id'].'">';
    $view .="/[削除]";
    $view .='</a>';
    $view .="</p>";
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー管理画面</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->

<!-- Head[End] -->

<!-- Main[Start] -->

<!-- 検索エリア[start] -->
  <!-- <form method="post" action="select.php">
    <div class="jumbotron">
      <fieldset>
        <label>sime：<input type="text" name="search_value"></label><br>
        <input type="submit" value="送信">
      </fieldset>
    </div>
  </form>
</div> -->

<!-- 検索エリア[end] -->



<!-- Main[End] -->
<!-- <div>
    <div class="u_name"></div>
</div> -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>

</body>
</html>