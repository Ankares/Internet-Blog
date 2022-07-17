<?php

  $id = $_POST['id'];

  require_once '../blocks/mysqlConnect.php';

  $query = $pdo->query('DELETE FROM chat WHERE id = ' .$id);
    echo 'Готово';
 ?>
