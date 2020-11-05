<?php
session_start();
require_once('funcs.php');
loginCheck();
// $postid = $_POST['id'];
$id = $_SESSION['id'];
// echo $_SESSION['id'];

//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET['id'];

//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
require_once("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=".$id);
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        //GETデータ送信リンク作成
        // <a>で囲う。   
}
?>


<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー情報編集</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="updateid.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ID編集</legend>
                <label>名前：<input type="text" name="name" value="<?=$result['name']?>"></label><br>
                <label>ID：<input type="text" name="lid" value="<?=$result['lid']?>"></label><br>
                <label>PASSWORD：<input type="text" name="lpw" value="<?=$result['lpw']?>"></label><br>
                <label>管理者チェック（管理者：1）：<input type="text" name="kanri_flg" value="<?=$result['kanri_flg']?>"></label><br>
                <label>在籍チェック（在籍者：1）：<input type="text" name="life_flg" value="<?=$result['life_flg']?>"></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>


