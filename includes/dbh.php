<?php

// データソースネーム
$dsn = 'mysql:dbname=galleryexample;host=localhost;charset=utf8';
// ユーザーネーム
$username = "root";
// パスワード
$password = "";
// データベースハンドラ
$dbh = new PDO(
    $dsn,
    $username, 
    $password, 
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // エラー発生時に例外を投げるようにする
        PDO::ATTR_EMULATE_PREPARES => false // 静的プレースホルダを用いる
    )
);

?>