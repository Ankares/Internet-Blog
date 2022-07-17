<?php
  $user = 'root';
  $password = 'root';
  $db = 'registration form';
  $host = 'localhost';

  $dsn = 'mysql:host='.$host.';dbname='.$db;
  $pdo = new PDO($dsn,$user,$password);
 ?>
