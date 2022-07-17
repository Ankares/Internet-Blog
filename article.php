<?php

  if($_COOKIE['log'] == ''){
    header('location: /Block 5 BLOG(ARTICLES,COMMS,MAIL)/registration.php');
    exit();
  }
 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Articles';
    require 'blocks/head.php' ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>
  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-5">

        <!-- Adding article -->
        <h4 class="mb-4">Добавление статьи</h4>

        <form action="" method="post">
          <label for="title">Заголовок статьи</label>
          <input type="text" name="title" id="title" class="form-control mb-3">
          <label for="intro">Интро статьи</label>
          <textarea name="intro" id="intro" class="form-control"></textarea>
          <label for="text">Текст статьи</label>
          <textarea name="text" id="text" class="form-control"></textarea>

          <div class="alert alert-danger" id="errorBlock"></div>
          <button type="button" id ="addArticle" class="btn btn-success mt-4 mb-5">Добавить</button>

        </form>
      </div>
    </div>
  </main>
<?php require 'blocks/footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script>

  // Add Article
  $('#addArticle').click(function(){
    var title = $('#title').val();
    var intro = $('#intro').val();
    var text = $('#text').val();

    $.ajax({
      url: 'ajax/add_article.php',
      type: 'POST',
      cache: false,

      data: {'title': title, 'intro': intro, 'text': text},
      dataType: 'html',

      success: function(data){
        if(data == 'Готово'){
          $('#addArticle').text('Всё готово');
          $('#errorBlock').hide();
        }
        else {
          $('#errorBlock').show();
          $('#errorBlock').text(data);
        }
      }
    });
  });
</script>
</body>
</html>
