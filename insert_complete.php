<?php
require_once("db_connect.php");

if (isset($_POST["name"]) && isset($_POST["message"])) {
  $name = $_POST["name"];
  $message = $_POST["message"];
  $time = date("Y-m-d H:i:s", time());
  try {
    $stmt = $pdo->prepare("INSERT INTO board (
      user_name, message, create_date
    ) VALUES (
      :name, :message, :datetime
    )");

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->bindParam(':datetime', $time, PDO::PARAM_STR);
    $flag = $stmt->execute();
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
  <title>投稿完了</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <?php
    if ($flag){
      echo "<h1>投稿が完了しました</h1>";
    }else{
      echo "<h1>投稿に失敗しました</h1>";
    }
  ?>

  <div class="link-wrap">
    <a class="link-btn" href="./index.php">投稿一覧へ戻る</a>
  </div>
</body>
</html>
