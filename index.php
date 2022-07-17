<!DOCTYPE html>
<html lang="ru">
<head>

  <?php
    $website_title = 'Articles';
    require 'blocks/head.php'
  ?>

</head>
<body>
  <?php require 'blocks/header.php'; ?>
  <main class="container mt-5">
    <div class="row">

      <!-- Articles page -->
      <div class="col-md-8 text-md-start text-center">
        <?php
          require_once './blocks/mysqlConnect.php';
          $query = $pdo->query('SELECT * FROM articles ORDER BY date DESC');
          while($row = $query->fetch(PDO::FETCH_OBJ)){
            echo "<h2>$row->title</h2>
            <p class='lead'>$row->intro</p>
            <p>$row->text</p>
            <p><b>Автор статьи</b>: <mark>$row->author<mark></p>"
            ."<a href='./news.php?id=$row->id' title='$row->title'>
              <button class='btn btn-warning mt-3 mb-5'>Прочитать больше</button>
            </a>";
          }
         ?>
      </div>

      <!-- Chat -->
      <div class="col-md-4 text-md-start text-center">
        <?php require 'blocks/aside.php'; ?>
        <form action="" method="post">
          <input type="text" name ="mess" id="mess" class="mb-3 form-control" placeholder="Сообщение">
          <div class="alert alert-danger" id="errorBlock" ></div>
          <div class="d-flex justify-content-between">
            <button type="button" id="btn_send" class="btn btn-success mb-5 col-lg-5 col-6">Отправить</button>
            <button id="dell_all" type="button" onclick="deleteAllMess()" class="btn btn-success mb-5 col-lg-5 col-5">Очистить чат</button>
          </div>

          <h4 id="chatLabel">Чат</h4>
          <div id="forMess">

          </div>

        </form>
      </div>
    </div>
  </main>
<?php require 'blocks/footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script>

// Send message to DB
  $('#btn_send').click(function(){
    var mess = $('#mess').val();

    $.ajax({
      url: 'ajax/chat.php',
      type: 'POST',
      cache: false,
      data: {'mess': mess},
      dataType: 'html',

      success: function(data){
        if(data == 'Готово'){
          $('#errorBlock').hide();
          $('#mess').val('');
          $('#dell_all').show();
        }
        else {
          $('#errorBlock').show();
          $('#errorBlock').text(data);
        }
      }
    })
  })

// Show message
  setInterval(function(){
        $.ajax({
          url: 'ajax/chatShow.php',
          type: 'POST',
          cache: false,
          data: {},
          dataType: 'html',

          success: function(data){
              $('#forMess').html(data);
          }
        })
  },500);

// Del message
  function deleteMessage(id){
    $.ajax({
      url: 'ajax/deleteMessage.php',
      type: 'POST',
      cache: false,
      data: {'id': id},
      dataType: 'html',
      success: function(data){
        if(data == 'Готово'){
          $('#' + id).remove();
        }
      }
    })
  }

// Del all messages
  function deleteAllMess(){
    $.ajax({
      url: 'ajax/deleteAllMess.php',
      type: 'POST',
      cache: false,
      data: {},
      dataType: 'html',
      success: function(data){
        if(data == 'Готово'){
          $('#dell_all').hide();
        }
      }
    })
  }
</script>
</body>
</html>
