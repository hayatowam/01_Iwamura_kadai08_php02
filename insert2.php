<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST["name"];
$email = $_POST["email"];
$naiyou = $_POST["naiyou"];

var_dump($name);
// exit(); //この上までちゃんと動いているかいなかのテストができる

// 2. DB接続します

try {
  //Password:MAMP='root',XAMPP=''
  // Try→チャレンジしますよ、の意味
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// ３．SQL文を用意(データ登録：INSERT)
// 一度仮の挿入位置を渡してあげるイメージ。実際の値は、４で指定し入力する
$stmt = $pdo->prepare(
  "INSERT INTO gs_an_table( id, name, email, naiyou, indate )
  VALUES( NULL, :name, :email, :naiyou, sysdate() )"
);
// 4. バインド変数を用意→クッションを挟むことで、文字列化してあげることが可能
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行→データの登録
$status = $stmt->execute();

// 6．データ登録処理後→エラーがなければ終了
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header('Location: index.php');//ヘッダーロケーション（リダイレクト）
}
?>
