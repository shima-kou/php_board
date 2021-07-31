<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/db_connect.php");
if (isset($_POST["id"])) {
  try {
    $stmt = $pdo->prepare('UPDATE board SET user_name = :name, message = :message WHERE id = :id');
    $flag = $stmt->execute(array(':name' => $_POST['name'], ':message' => $_POST['message'], ':id' => $_POST['id']));
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
  <title>編集完了</title>
  <link rel="stylesheet" href="./css/main.css">
</head>
<body>
  <?php
    if ($flag){
      echo "<h1>編集が完了しました</h1>";
    }else{
      echo "<h1>編集に失敗しました</h1>";
    }
  ?>

  <div class="link-wrap">
    <a class="link-btn" href="../../index.php">投稿一覧へ戻る</a>
  </div>
</body>
</html>
