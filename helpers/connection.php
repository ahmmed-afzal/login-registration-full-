<?php
  $dsn = 'mysql:dbname=crud;host=localhost';

  try {
  $db = new PDO($dsn,'root','');
  $db ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

  } catch (\Exception $e) {
  echo $e->getMessage();

  }


 ?>
