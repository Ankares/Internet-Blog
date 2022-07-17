<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Registration';
    require 'blocks/head.php' ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>
  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-5">

        <!-- Registration -->
        <h4 class="mb-4">Форма Регистрации</h4>
        <form action="" method="post">
          <label for="username">Name</label>
          <input type="text" name="username" id="username" class="form-control mb-3">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control mb-3">
          <label for="login">Login</label>
          <input type="text" name="login" id="login" class="form-control mb-3">
          <label for="pass">Password</label>
          <input type="password" name="pass" id="pass" class="form-control mb-3">
          <div class="alert alert-danger" id="errorBlock"></div>
          <button type="button" id ="reg_user" class="btn btn-success mt-4 mb-5">Зарегистрироваться</button>
        </form>
      </div>
    </div>
  </main>
<?php require 'blocks/footer.php'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script>

  // Reg
  $('#reg_user').click(function(){
    var name = $('#username').val();
    var email = $('#email').val();
    var login = $('#login').val();
    var pass = $('#pass').val();

    $.ajax({
      url: 'ajax/reg.php',
      type: 'POST',
      cache: false,
      data: {'username': name, 'email': email, 'login':login, 'pass': pass},
      dataType: 'html',

      success: function(data){
        if(data == 'Готово'){
          $('#reg_user').text('Всё готово');
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