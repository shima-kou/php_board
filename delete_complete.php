<?php
require_once("db_connect.php");

if (isset($_POST["id"])) {
  $id = $_POST["id"];
  try {
    $stmt = $pdo->prepare('DELETE FROM board WHERE id = :id');
    $flag = $stmt->execute(array(':id' => $_POST['id']));
    $pdo = null;
  } catch (PDOException $e) {
    echo $e->getMessage();
    $pdo = null;
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>削除完了</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <?php
    if ($flag){
      echo "<h1>投稿の削除が完了しました</h1>";
    }else{
      echo "<h1>投稿の削除に失敗しました</h1>";
    }
  ?>

  <div class="link-wrap">
    <a class="link-btn" href="./index.php">投稿一覧へ戻る</a>
  </div>
</body>
</html>
