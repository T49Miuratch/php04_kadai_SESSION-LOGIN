<?php
//1. POSTデータ取得
$dialogue   = $_POST['dialogue'];
$mangatitle  = $_POST['mangatitle'];
$author = $_POST['author'];
$source    = $_POST['source'];
$comment    = $_POST['comment'];
$id     = $_POST['id'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('UPDATE gs_an_table SET name=:name,email=:email,age=:age,naiyou=:naiyou WHERE id=:id;');
$stmt->bindValue(':dialogue',   $dialogue,   PDO::PARAM_STR);
$stmt->bindValue(':mangatitle',  $mangatitle,  PDO::PARAM_STR);
$stmt->bindValue(':author',    $author,    PDO::PARAM_STR);
$stmt->bindValue(':source', $source, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('index.php');
}
