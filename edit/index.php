<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/db_connect.php");

if (isset($_POST["id"])) {
  $id = $_POST["id"];
  try {
    $stmt = $pdo->prepare('SELECT * FROM board WHERE id = :id');
    $stmt->execute(array(':id' => $_POST['id']));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
  <title>編集</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <form action="./thanks/index.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <p>名前: <input type="text" name="name" value="<?php echo $result['user_name'] ?>" /></p>
    <div class="textarea-wrap">
      <p>投稿内容:</p>
      <textarea name="message" cols="30" rows="10"><?php echo $result['message'] ?></textarea>
    </div>
    <div class="btn-wrap">
      <button type="submit" value="更新">更新</button>
      <button type="button" id="backBtn">戻る</button>
    </div>
  </form>
  <script>
    const backBtn = document.getElementById('backBtn');
    backBtn.addEventListener('click', () => {
      location.href = '../';
    });
  </script>
</body>
</html>
