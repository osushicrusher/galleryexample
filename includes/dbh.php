<?php

// データソースネーム
$dsn = 'mysql:dbname=j3hem_phpgallery_db;host=mysql21.onamae.ne.jp;charset=utf8';
// ユーザーネーム
$username = "j3hem_osushicrusher";
// パスワード
$password = "yh100906!";
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