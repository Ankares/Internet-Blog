<!DOCTYPE html>
<html lang="ru">
<head>

  <?php
  require_once './blocks/mysqlConnect.php';

  // Select article
  $sql = 'SELECT * FROM articles WHERE id = :id';
  $id = $_GET['id'];
  $query= $pdo->prepare($sql);
  $query->execute(['id'=>$id]);

  $article = $query->fetch(PDO::FETCH_OBJ);
  $website_title = $article->title;
  require 'blocks/head.php'
  ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>
  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 text-md-start text-center">

        <!-- Article -->
        <div class="container bg-light p-5">
          <h1><?=$article->title?></h1>
          <p><b>Автор статьи: </b><mark><?=$article->author?></mark></p>
          <?php
            $date = date('d ',$article->date);
            $array = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
            $date .= $array[date('n',$article->date)-1];
            $date .= date(' H:i', $article->date);
           ?>
          <p><b>Время публикации: </b><u><?=$date?></u></p>
          <p><?=$article->intro?></p>
          <br>
          <p><?=$article->text?></p>
        </div>

        <!-- Add comment -->
        <h3 class="mt-3">Комментарии</h3>
        <form action="./news.php?id=<?=$_GET['id']?>" method="post">
          <label for="username">Имя</label>
          <input type="text" name="username" value="<?=$_COOKIE['log']?>"id="username" class="form-control mb-3">
          <label for="mess">Сообщение</label>
          <textarea name="mess" id="mess" class="form-control mb-3"></textarea>
          <button typ="submit" id ="send_mess" class="btn btn-success mt-4 mb-5">
            Добавить комментарий
          </button>
        </form>

        <!-- Add comment to DB -->
        <?php
          if($_POST['username'] != '' && $_POST['mess'] != ''){
            $username = trim(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
            $message = trim(filter_var($_POST['mess'],FILTER_SANITIZE_STRING));

            $sql = 'INSERT INTO comments(name,message,article_id) VALUES(?,?,?)';
            $query = $pdo->prepare($sql);
            $query->execute([$username,$message,$_GET['id']]);
          }

          // Show comments
          $sql = 'SELECT * FROM comments WHERE article_id = :id ORDER BY id DESC';
          $query = $pdo->prepare($sql);
          $query->execute(['id'=>$_GET['id']]);
          $comments = $query->fetchAll(PDO::FETCH_OBJ);

          foreach($comments as $comment){
            echo "<div class = 'alert alert-info mb-3'>
            <h4>$comment->name</h4>
            <p>$comment->message</p>
            </div>";
          }
         ?>
      </div>
      <div class="col-md-4 text-md-start text-center">
    <?php require 'blocks/aside.php'; ?>
      </div>
    </div>
  </main>
<?php require 'blocks/footer.php'; ?>
</body>
</html>
