<?php

  $username = trim(filter_var($_POST['username'],FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'],FILTER_SANITIZE_EMAIL));
  $message = trim(filter_var($_POST['mess'],FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($username) <= 3)
    $error = 'Введите имя';
  else if(strlen($email) <= 5)
    $error = 'Введите почту';
  else if(strlen($message) <= 15)
    $error = 'Введите сообщение (не менее 15 символов)';

  if($error !=''){
    echo $error;
    exit();
  }

  $my_mail = "test@mail.ru";
  $subject = "=?utf-8?B?".base64_encode("Новое сообщение с сайта")."?=";
  $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";

  mail($my_mail,$subject,$message,$headers);

  echo 'Готово';
 ?>
