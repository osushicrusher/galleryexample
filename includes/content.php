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
    <title>詳細ページ</title>
</head>
<body>
    <div class="wrapper">
        <h1 class="heading-primary">のらねこフォト</h1>  
        <main>
            <div class="content">
            <?php
                echo '<div style="background-image: url(../img/'.$imageFullName.');" class="content__img-box"></div>
                        <div class="content__desc-box">
                            <h2 class="">'.$title.'</h2>
                            <p>'.$desc.'</p>
                            <div class="btn-box">
                                <form method="POST" action="edit-check.php">
                                    <input type="submit" name="edit" value="修正">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="hidden" name="imgfullname" value="'.$imageFullName.'">
                                    <input type="hidden" name="title" value="'.$title.'">
                                    <input type="hidden" name="desc" value="'.$desc.'">
                                </form>
                                <form method="POST" action="delete-check.php">
                                    <input type="submit" name="delete" value="削除">
                                    <input type="hidden" name="id" value="'.$id.'">
                                    <input type="hidden" name="imgfullname" value="'.$imageFullName.'">
                                    <input type="hidden" name="title" value="'.$title.'">
                                    <input type="hidden" name="desc" value="'.$desc.'">
                                </form>
                            </div>
                        </div>';
            ?>
            </div>
        </main>
    </div>
</body>
</html>