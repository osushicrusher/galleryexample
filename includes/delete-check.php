<?php

$id = $_POST['id'];
$imageFullName = $_POST['imgfullname'];
$desc = $_POST['desc'];
$title = $_POST['title'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>削除画面</title>
</head>
<body>
    <div class="wrapper">
        <h1 class="heading-primary">のらねこフォト</h1>   
        <main>
            <div class="content">
            <?php
                echo '<div style="background-image: url(../img/'.$imageFullName.');" class="content-img-box"></div>
                    <div class="content-desc">
                        <h2 class="">'.$title.'</h2>
                        <p>'.$desc.'</p>
                        <p class="delete-text">本当に削除しますか？</p>
                        <div class="btn-box">
                        <form method="POST" action="delete-done.php">
                            <input type="button" onclick="history.back()" value="戻る">
                            <input type="submit" name="delete" value="削除">
                            <input type="hidden" name="id" value="'.$id.'">
                        </form>
                        </div>
                    </div>';
            ?>
            </div>
        </main>
    </div>
</body>
</html>