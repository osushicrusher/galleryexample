<?php

    if (isset($_POST['submit'])) {
        $newFileName = $_POST['filename'];
        // もし変数が空だったら
        if (empty($_POST['filename'])) {
            $newFileName = "gallery";
        } else {
            // スペースがある場合はハイフンで置換、書き換える
            $newFileName = strtolower(str_replace(" ", "-", $newFileName));
        }
        $imageTitle = $_POST['filetitle'];
        $imageDesc = $_POST['filedesc'];

        $file = $_FILES['file'];

        $fileName = $file["name"];
        $fileType = $file["type"];
        $fileTempName = $file["tmp_name"];
        $fileError = $file["error"];
        $fileSize = $file["size"];

        // ファイル名と拡張子を分割
        $fileExt = explode(".", $fileName);
        // 
        $fileActualExt = strtolower(end($fileExt));

        // 追加可能な拡張子タイプの指定
        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                if ($fileSize < 2000000) {
                    $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                    $fileDestination = "img/" . $imageFullName;

                    // データベースへの接続
                    include_once "dbh.php";

                    if (empty($imageTitle) || empty($imageDesc)) {
                        header("Location: ../index.php?upload=empty");
                        exit();
                    } else {
                        $sql = "SELECT * FROM gallery;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL文が無効です";
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $rowCount = mysqli_num_rows($result);
                            $setImageOrder = $rowCount + 1;

                            $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?);";

                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "SQLのステートメントが無効です";
                            } else {
                                mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
                                mysqli_stmt_execute($stmt);

                                move_uploaded_file($fileTempName, $fileDestination);

                                header("Location: ../index.php?upload=success");
                            }
                        }
                    }
                } else {
                    echo "ファイルサイズが大きすぎます";
                    exit();
                }
            } else {
                echo "エラーが発生しました";
                exit();
            }
        } else {
            echo "投稿可能なのはjpg, jpeg, png形式に限定されています。";
            exit();
        }
    }

?>