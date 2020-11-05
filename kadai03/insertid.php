<?php
session_start();
require_once('funcs.php');
loginCheck();
// $postid = $_POST['id'];
$id = $_SESSION['id'];
// echo $_SESSION['id'];

// indexに入力したデータを受信
$name=$_POST['name'];
$lid=$_POST['lid'];
$lpw=$_POST['lpw'];
$kanri_flg=$_POST['kanri_flg'];
$life_flg=$_POST['life_flg'];

//2. DB接続
require_once('funcs.php');
$pdo=db_conn();


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO 
                        gs_user_table
                          (id, name, lid, lpw, kanri_flg, life_flg)
                        VALUES
                          ( NULL,:name,:lid,:lpw,:kanri_flg,:life_flg)
                      ");
// $stmt->bindValue(':id', h($id), PDO::PARAM_INT);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', h($lid), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', h($lpw), PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', h($life_flg), PDO::PARAM_INT);      //Integer（数値の場合 PDO::PARAM_INT)

// -- 実行分
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("記録ができません".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: selectid.php');
}
?>
