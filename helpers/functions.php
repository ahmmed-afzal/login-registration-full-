<?php
if(!function_exists('db_connect')){
  function db_connect(){
    $db  = false;
    $dsn = 'mysql:dbname=crud;host=localhost';

    try {
      $db = new PDO($dsn,'root','');
      $db ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    } catch (\Exception $e) {
      echo $e->getMessage();

    }
    return $db;
  }
}
if(!function_exists('notification')){
  function notification($message,$type = 'success')
  {
    $_SESSION['message'] = $message;
    $_SESSION['type']    = $type;
  }
}
if(!function_exists('redirect')){
  function redirect($location='index.php')
  {
    header('location: '.$location);
    exit();
  }
}
if(!function_exists('is_logged_in')){
  function is_logged_in()
  {
    return isset($_SESSION['id'],$_SESSION['role'],$_SESSION['email']);
  }
}
if(!function_exists('is_admin')){
  function is_admin()
  {
    return $_SESSION['role']==='admin';
  }
}
if(!function_exists('user')){
  function user()
  {
    if(!is_logged_in()){
      return false;
    }
    return[
        'id'=>(int)$_SESSION['id'],
        'role'=>$_SESSION['role'],
        'email'=>$_SESSION['email']
    ];
  }
}
if(!function_exists('dd')){
  function dd($var)
  {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
  }
}
