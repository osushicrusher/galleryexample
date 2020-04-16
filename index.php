<?php
    $_SESSION['username'] = "j3hem_osushicrusher";
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>のらねこフォト</title>
</head>
<body>
    <div class="wrapper">
        <h1 class="heading-primary">のらねこフォト</h1>    
        <main>
        <?php
            if(isset($_SESSION['username'])) {
                echo '<section class="gallery-upload">
                <form action="includes/gallery-upload.php" method="POST" enctype="multipart/form-data">
                    <p><input type="text" name="filename" placeholder="ファイル名"></p>
                    <p><input type="text" name="filetitle" placeholder="写真の名前"></p>
                    <p><input type="text" name="filedesc" placeholder="写真の説明"></p>
                    <p><input type="file" name="file"></p>
                    <button type="submit" name="submit">追加する</button>
                </form>
            </section>';
            }
        ?>
            <section class="gallery-items">
                <?php

                include_once 'includes/dbh.php';

                // SQL文を設定
                $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";

                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);

                if (!$stmt) {
                    echo "SQL文が無効です";
                } else {
                    // statementの実行
                    $stmt->execute();

                    while (true) {

                        // 結果セットの取得
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($result === false) {
                            break;
                        }
                        echo '<div class="gallery-item">
                        <a href="" class="item-link">
                            <div style="background-image: url(img/'.$result["imgFullNameGallery"].');" class="img-box"></div>
                            <h2 class="heading-secondary">'.$result["titleGallery"].'</h2>
                            <p>'.$result["descGallery"].'</p>
                        </a>
                        <form method="POST" action="includes/content.php" enctype="multipart/form-data">
                        <p class="txt-center"><input type="submit" value="詳細"></p>
                        <input type="hidden" name="id" value="'.$result["idGallery"].'">
                        <input type="hidden" name="imgfullname" value="'.$result["imgFullNameGallery"].'">
                        <input type="hidden" name="title" value="'.$result["titleGallery"].'">
                        <input type="hidden" name="desc" value="'.$result["descGallery"].'">
                        </form>
                    </div>';
                    }
                }

                ?>
            </section>
        </main>
    </div>
</body>
</html>