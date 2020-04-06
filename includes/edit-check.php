
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
    <title>編集画面</title>
</head>
<body>
    <div class="wrapper">
        <h1 class="heading-primary">のらねこフォト</h1> 
        <main>
            <div class="content txt-center">
            <?php
                echo '<div style="background-image: url(../img/'.$imageFullName.');" class="content-img-box"></div>
                    <div class="content-desc">
                        <form method="POST" action="edit-done.php">
                        <label id="editedtitle">名前</label>
                        <p><input type="text" name="editedtitle" value="'.$title.'"></p>
                        <label id="editeddesc">説明</label>
                        <p><input type="text" name="editeddesc" value="'.$desc.'"></p>
                        <input type="button" onclick="history.back()" value="戻る">
                        <input type="submit" name="edit" value="変更">
                        <input type="hidden" name="id" value="'.$id.'">
                        </form>
                    </div>';
            ?>
            </div>
        </main>
        <footer id="footer" class="footer">

        </footer>
    </div>
</body>
</html>