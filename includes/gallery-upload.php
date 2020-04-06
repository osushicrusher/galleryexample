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
                    $fileDestination = "../img/" . $imageFullName;

                    // データベースへの接続
                    include_once "dbh.php";

                    if (empty($imageTitle) || empty($imageDesc)) {
                        header("Location: ../index.php?upload=empty");
                        exit();
                    } else {
                        // SQL文を設定
                        $sql = "SELECT * FROM gallery;";
                        // SQL文を実行する準備
                        $stmt = $dbh->prepare($sql);
                        
                        if (!$stmt) {
                            echo "SQL文が無効です";
                        } else {
                            // statementの実行
                            $stmt->execute();
                            // データの取得
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                            // 結果セットの行の数を返す
                            $rowCount = mysqli_stmt_num_rows($result);
                            // 数を合わせるため１を足す
                            $setImageOrder = $rowCount + 1;
                            // SQL文の準備
                            $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) VALUES (?, ?, ?, ?);";

                            if (!$stmt) {
                                echo "SQLのステートメントが無効です";
                            } else {
                                // SQL文を実行する準備
                                $stmt = $dbh->prepare($sql);
                                // 値をバインドする
                                $stmt->bindValue(1, $imageTitle);
                                $stmt->bindValue(2, $imageDesc);
                                $stmt->bindValue(3, $imageFullName);
                                $stmt->bindValue(4, (int)$setImageOrder, PDO::PARAM_INT);

                                // statementの実行
                                $stmt->execute();

                                // ファイルの保存場所の変更
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
