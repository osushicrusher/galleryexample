<?php
    $_SESSION['username'] = "Admin"
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <header id="header" class="header">
            <h1 class="heading-primary">のらねこ</h1>
            <ul class="nav-lists">
                <li class="nav-list">会員登録</li>
                <li class="nav-list">ログイン</li>
            </ul>    
        </header>
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

                $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL文が無効です";
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="gallery-item">
                        <a href="#" class="item-link">
                            <div style="background-image: url(img/'.$row["imgFullNameGallery"].');" class="img-box"></div>
                            <h2 class="heading-secondary">'.$row["titleGallery"].'</h2>
                            <p>'.$row["descGallery"].'</p>
                        </a>
                    </div>';
                    }
                }

                ?>
            </section>
        </main>
        <footer id="footer" class="footer">

        </footer>
    </div>
</body>
</html>