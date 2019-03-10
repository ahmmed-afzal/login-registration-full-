<?php
require_once 'config.php';
$token =trim($_GET['token']);
$query ="SELECT COUNT(id) as count FROM users WHERE activation_token=:token";
$stmt = $db->prepare($query);
$stmt ->bindParam(':token',$token);
$stmt->execute();
$result= $stmt->fetch();
$user_exist = $result['count'];
if((bool)$user_exist===true){
  $query = "UPDATE users SET active=1, activation_token=null WHERE activation_token=:token";
  $stmt = $db->prepare($query);
  $stmt ->bindParam(':token',$token);
  $stmt->execute();
  notification('Accounted Activated');
  redirect('login.php');
}else{
  notification('User token Invalid!','danger');
  redirect('index.php');
}
