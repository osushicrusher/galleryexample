
<?php

try {

    $editedTitle = $_POST['editedtitle'];

    $editedDesc = $_POST['editeddesc'];

    $id = $_POST['id'];

    // データベースへの接続
    include_once "dbh.php";

    // SQL文を設定
    $sql = "UPDATE gallery SET titleGallery=?, descGallery=? WHERE idGallery=?";

    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);

    // 値をバインドする
    $stmt->bindValue(1, $editedTitle);
    $stmt->bindValue(2, $editedDesc);
    $stmt->bindValue(3, (int)$id, PDO::PARAM_INT);

    // statementの実行
    $stmt->execute();


    header('Location: ../index.php');

} catch (PDOException $e) {
    $error = $e->getMessage();
}

?>
