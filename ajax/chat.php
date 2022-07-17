<?php

  $mess = trim(filter_var($_POST['mess'],FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($mess) <= 5)
    $error = 'Введите сообщение';

  if($error != ''){
    echo $error;
    exit();
  }

  require_once '../blocks/mysqlConnect.php';

  $sql = 'INSERT INTO chat(login,message) VALUES(?,?)';
  $query = $pdo->prepare($sql);
  $query->execute([$_COOKIE['log'],$mess]);


  echo 'Готово';
 ?>
