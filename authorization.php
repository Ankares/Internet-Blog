<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Authorization';
    require 'blocks/head.php' ?>
</head>
<body>
  <?php require 'blocks/header.php'; ?>
  <main class="container mt-5">
    <div class="row">
      <div class="col-md-8 mb-5">
        <?php
        if($_COOKIE['log'] == ''):
        ?>

         <!-- Authorization -->
        <h4 class="mb-4">Форма Авторизации</h4>
        <form action="" method="post">
          <label for="login">Login</label>
          <input type="text" name="login" id="login" class="form-control mb-3">
          <label for="pass">Password</label>
          <input type="password" name="pass" id="pass" class="form-control mb-3">
          <div class="alert alert-danger" id="errorBlock"></div>
          <button type="button" id ="auth_user" class="btn btn-success mt-4 mb-5">Войти</button>
        </form>

        <?php
          else:
         ?>
         <h2>Добро пожаловать, <?=$_COOKIE['log']?></h2>
         <button class="btn btn-danger mt-4" id="exit">Выйти</button>
        <?php
          endif;
         ?>

      </div>
    </div>
  </main>
<?php require 'blocks/footer.php'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<script>

  // Auth
  $('#auth_user').click(function(){
    var login = $('#login').val();
    var pass = $('#pass').val();

    $.ajax({
      url: 'ajax/auth.php',
      type: 'POST',
      cache: false,
      data: {'login':login, 'pass':pass},
      dataType: 'html',
      success: function(data){
        if(data == 'Готово'){
          $('#auth_user').text('Готово');
          $('#errorBlock').hide();
          document.location.reload(true);
        } else {
          $('#errorBlock').show();
          $('#errorBlock').text(data);
        }
      }
    });
  });

  // Exit
  $('#exit').click(function(){
    $.ajax({
      url: 'ajax/exit.php',
      type: 'POST',
      cache: false,
      data: {},
      dataType: 'html',
      success: function(data){
        document.location.reload(true);  
      }
    });
  });
</script>
</body>
</html>
