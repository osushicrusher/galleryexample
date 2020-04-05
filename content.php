<?php

$imageFullName = $_POST['imgfullname'];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo '<div style="background-image: url(img/'.$imageFullName.');" class="img-box"></div>';
    ?>
</body>
</html>