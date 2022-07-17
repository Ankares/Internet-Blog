<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Contacts';
    require 'blocks/head.php' ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>
  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-5">

        <!-- Contacts -->
        <h4 class="mb-4">Обратная связь</h4>
        <form action="" method="post">
          <label for="username">Имя</label>
          <input type="text" name="username" id="username" class="form-control mb-3">
          <label for="email">Почта</label>
          <input type="email" name="email" id="email" class="form-control mb-3">
          <label for="mess">Сообщение</label>
          <textarea name="mess" id="mess" class="form-control mb-3"></textarea>
          <div class="alert alert-danger" id="errorBlock"></div>
          <button type="button" id ="mess_send" class="btn btn-success mt-4 mb-5">Отправить сообщение</button>
        </form>

      </div>
    </div>
  </main>
<?php require 'blocks/footer.php'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script>

  // Send message
  $('#mess_send').click(function(){
    var name = $('#username').val();
    var email = $('#email').val();
    var message = $('#mess').val();

    $.ajax({
      url: 'ajax/mail.php',
      type: 'POST',
      cache: false,
      data: {'username': name, 'email': email, 'mess': message},
      dataType: 'html',

      success: function(data){
        if(data == 'Готово'){
          $('#mess_send').text('Всё готово');
          $('#errorBlock').hide();
          $('#username').val('');            
          $('#email').val('');
          $('#mess').val('');
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
