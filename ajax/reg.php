<?php

  $username = trim(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
  $login = trim(filter_var($_POST['login'],FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'],FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($username) <= 3)
    $error = 'Введите имя';
  else if(strlen($email) <= 5)
    $error = 'Введите почту';
  else if(strlen($login) <= 3)
    $error = 'Введите логин';
  else if(strlen($pass) <= 5)
    $error = 'Введите пароль';

  if($error !=''){
    echo $error;
    exit();
  }

  $hash = "adwdlkjawldkjawlddac";
  $pass = md5($pass . $hash);

  require_once '../blocks/mysqlConnect.php';

  $sql = 'INSERT INTO users(name,email,login,password) VALUES(?,?,?,?)';
  $query = $pdo->prepare($sql);
  $query->execute([$username,$email,$login,$pass]);

  echo 'Готово';  
 ?>
