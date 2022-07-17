<?php

  require_once '../blocks/mysqlConnect.php';

  $query = $pdo->query('SELECT * FROM chat ORDER BY id DESC');
  $items = $query->fetchAll(PDO::FETCH_ASSOC);
  if(count($items) == 0)
    echo '<div class="alert alert-warning">Новых сообщений нет</div>';
  else{
    foreach($items as $el)
      echo '<div id="'.$el['id'].'"class = "alert alert-info mb-2 p-3 text-start">'.'<strong>'.'<button onclick="deleteMessage('.$el['id'].')" type="button" class="btn btn-outline p-1 float-end">&times;</button>'.$el['login'].'</strong>'.'<br>'.$el['message'].'</div>';
  }
?>
