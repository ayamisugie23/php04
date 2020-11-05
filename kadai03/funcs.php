<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}
//DB接続関数：db_conn()
function db_conn()
{
    try {
        $db_name = "want_book_data";    //データベース名
        $db_host = "localhost"; //DBホスト
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}
//SQLエラー関数：sql_error($stmt)
function sql_error($stmt)
{
    $error = $stmt->errorInfo();
    exit("SQLError:" . $error[2]);
}
//リダイレクト関数: redirect($file_name)
function redirect($file_name)
{
    header('Location: ' . $file_name);
    exit();
}

// ログインチェック処理
function sessionCheck()
{
    // 1. ログインチェック処理！
    // 以下、セッションID持ってたら、ok
    // 持ってなければ、閲覧できない処理にする。
    if(!isset ($_SETTION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
        exit('LOGIN Error');
    }else{
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }

}


// ログイン認証関数
function loginCheck(){
    if(
        // ブラウザ内にセッションIDが付与されておりかつ、一致する→select.php
        !isset($_SESSION['chk_ssid'])
        ||
        $_SESSION['chk_ssid']!=session_id()
        ){
          // ログインエラーメッセージ
          echo "Login Error";
          echo '<a href="login.php">→ログイン画面</a>';
          exit();
        }else{
          // セッションIDを再生成（ハッキング対策）
          session_regenerate_id(true);
          $_SESSION['chk_ssid']=session_id();
        }
}

function loginId(){
    //1.  DB接続します
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
            $id = $result["id"];
  
    }
}