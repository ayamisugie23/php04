<?php
session_start();
require_once('funcs.php');
loginCheck();
$id = $_SESSION['id'];
// echo $_SESSION['id'];

//＜ユーザー情報取得＞
//１．PHP
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=want_book_data;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
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
?>


<?php
//＜本リスト取得＞
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=want_book_data;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

// //３．データ表示
// $view="";
// if ($status==false) {
//     //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);

// }else{
//   //Selectデータの数だけ自動でループしてくれる
//   //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
//   // while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//   //   $view .= "<table>";
//   //   $view .= "<td><input type="checkbox"></td><td>".$result['datetime']."</td><td>".$result['title']."</td><td>".$result['writer']."</td><td>".$result['publisher']."</td><td>".$result['price']."</td><td>".$result['amazon']."</td><td>".$result['memo']."</td>";
//   //   $view .= "</table>";
//   // }
//   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $view .= "<p>";
//     $view .= $result['datetime']." ".$result['title']." ".$result['writer']." ".$result['publisher']." ".$result['price']."円 ".$result['amazon']." ".$result['memo'];
//     $view .= "</p>";
//   }
// }

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        // <a href="detail.php?id=XXX">
        $view .= '<a href="detail.php?id=' . $result["id"] . '">';
        $view .= $result["datetime"] . "：" . $result["title"]. "/" .$result["writer"];
        $view .= '</a>';
        $view .= '<a href="delete.php?id=' . $result["id"] . '">';
        $view .= '[ 削除 ]';
        $view .= '</a>';
        $view .= '</p>';
    }
}



?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>買う本一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<style>.headermenu{padding: 10px; color:white;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">買う本リスト</a>
      <div class="navbar-header"><?= $viewuser ?></div>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
