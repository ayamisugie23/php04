<?php
session_start();
require_once('funcs.php');
loginCheck();
// $postid = $_POST['id'];
$id = $_SESSION['id'];
echo $_SESSION['id'];

session_start();
$lid=$_POST['lid'];
$lpw=$_POST['lpw'];
echo $lid;

//1. DB接続します
require_once('funcs.php');
$pdo=db_conn();


//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND lpw=:lpw");
$stmt->bindValue(':lid',$lid,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw',$lpw,PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//３．データ表示
$result="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  $result=$stmt->fetch();
  echo $result['id'];
  echo $result['lid'];
  }

if($result['id']!=""){
  $_SESSION['chk_ssid']=session_id();
  $_SESSION['name']=$result['name'];
  $_SESSION['kanri_flg']=$result['kanri_flg'];
    //セッションにIDを保存
  $_SESSION['id'] = $result['id'];
  // header("Location:select.php");
}else{
  header("Location:login.php");
}

// // 管理者権限と一般権限で画面を分岐
// if($result['kanri_flg']==0){
//   header("Location:select_G.php");
// }else{
//   header("Location:select.php");
// }

    header("Location:index.php");
?>

<body>
</body>
</html>
