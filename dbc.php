<?php

//データベースに接続する関数定義
function dbConect()
{
  $dsn = 'mysql:host=localhost;dbname=blog_app;cherset=utf8';
  $user = 'blog_user2';
  $pass = 'Tetsunari123';

  try {
    $dbh = new PDO($dsn,$user,$pass,[
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    // echo '接続成功';
  } catch(PDOException $e) {
    echo '接続失敗' . $e->getMessage();
    exit();
  };
  return $dbh;
}

//データを取得する関数定義
function getAllBlog()
{
  $dbh = dbConect();
  //sqlの準備
  $sql = 'SELECT * FROM blog';
  //sqlの実行
  $stmt = $dbh->query($sql);
  //sqlの結果を受け取る
  $result = $stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
  $dbh = null; 
}
//取得したデータを表示
$blogData = getAllBlog();

//カテゴリー名を表示する関数定義
function setCategoryName($category)
{
  if ($category === '1'){
    return 'ブログ';
  } elseif ($category === '2'){
    return '日常';
  } else {
    return 'その他';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ一覧</title>
</head>
<body>
  <h2>ブログ一覧</h2>
  <table>
    <tr>
      <th>NO</th>
      <th>タイトル</th>
      <th>カテゴリー</th>
    </tr>
    <?php foreach($blogData as $column): ?>
    <tr>
      <td><?php echo $column['id'] ?></td>
      <td><?php echo $column['title'] ?></td>
      <td><?php echo setCategoryName($column['category']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>