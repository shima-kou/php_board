<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP board</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <?php require("db_connect.php"); ?>
  <h1>掲示板</h1>
  <div class="newpost-wrap">
    <form action="./insert_complete.php" method="POST">
      <p class="name">
        <span>name:</span>
        <input type="text" name="name" value="" required />
      </p>
      <div class="message-wrap">
        <p>投稿内容：</p>
        <textarea name="message" cols="30" rows="10" required ></textarea>
      </div>
      <div class="btn-wrap">
        <button type="submit" value="投稿">投稿</button>
      </div>
    </form>
  </div>

  <div class="board-wrap">
  <?php
    try {
      $sql_statement = "SELECT * FROM board";
      $exec = $pdo->prepare($sql_statement);
      $exec->execute();
      $result = $exec->fetchAll(PDO::FETCH_ASSOC);

      if(count($result) > 0) {
        $counter = 0;
        $html = "";
        foreach ($result as $value) {
          $counter++;
          $post = "
          <div class='post-wrap'>
            <form action='./delete_complete.php' method='POST'>
              <p>No:{$counter}</p>
              <p>名前:{$value['user_name']}</p>
              <p>投稿内容:{$value['message']}</p>
              <div>
                <input type='hidden' name='id' value='{$value['id']}' />
                <button type='submit' value='削除'>削除</button>
              </div>
            </form>
          </div>
          ";
          $html .= $post;
        }
        echo $html;
      } else {
        echo "現在投稿はありません";
      }
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    $pdo = null;
  ?>
  </div>
</body>
</html>
