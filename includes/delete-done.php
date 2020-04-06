<?php

try {

    $id = $_POST['id'];

    // データベースへの接続
    include_once "dbh.php";

    // SQL文の設定
    $sql = "DELETE FROM gallery WHERE idGallery=?";

    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);

    // 値をバインドする
    $stmt->bindValue(1, (int)$id, PDO::PARAM_INT);

    // statementの実行
    $stmt->execute();

    header('Location: ../index.php');

} catch (PDOException $e) {
    $error = $e->getMessage();
}

?>