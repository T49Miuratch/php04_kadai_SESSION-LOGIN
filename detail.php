<?php

$id = $_GET['id']; //?id~**を受け取る

session_start();
require_once('funcs.php');
loginCheck();

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_an_table WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>[編集]</legend>
                <label>セリフ<br><textArea name="dialogue" rows="4" cols="50"><?= $row['dialogue'] ?></textArea></label><br>
                <label>セリフの元画像（任意）<br><input type="file" name="img"></label><br>
                <label>マンガのタイトル<br><input type="text" name="mangatitle" size="54" value="<?= $row['mangatitle'] ?>"></label><br>
                <label>作者名<br><input type="text" name="author" value="<?= $row['author'] ?>"></label><br>
                <label>出典・巻数<br><input type="text" name="source" size="24" value="<?= $row['source'] ?>"></label><br>
                <label>コメント<br><textArea name="comment" rows="2" cols="50"><?= $row['comment'] ?></textArea></label><br>
                <input type="submit" value="送信">
                <input type="hidden" name="id" value="<?= $id ?>">
            </fieldset>
        </div>
    </form>

    <!-- Main[End] -->


</body>

</html>
