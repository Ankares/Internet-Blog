<?php

  require_once '../blocks/mysqlConnect.php';

  $query = $pdo->query('DELETE FROM chat');
    echo 'Готово';
 ?>
