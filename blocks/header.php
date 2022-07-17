<div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom border-2">
    <span class="fs-4 ms-0 ms-md-5 mt-2">PHP BLOG</span>
    <nav class="mt-2 ms-5 ms-md-0 mt-md-0 ms-md-auto">
      <a href="./index.php" class="btn btn-outline mt-3">Главная</a>
      <a href="./contacts.php" class="btn btn-outline mt-3">Контакты</a>
      <?php
        if($_COOKIE['log'] == ''):

       ?>
      <a href="./authorization.php" class="btn btn-outline-primary mt-3">Войти</a>
      <a href="./registration.php" class="btn btn-outline-primary me-5 mt-3" >Регистрация</a>
      <?php
        else:
       ?>
      <a class="btn btn-outline mt-3" href="./article.php">Добавить Статью</a>
      <a href="./authorization.php" class="btn btn-outline-primary me-5 mt-3">Кабинет пользователя - <?=$_COOKIE['log']?></a>
      <?php
        endif; 
       ?>
    </nav>
</div>
