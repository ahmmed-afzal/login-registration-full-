<?php
require_once 'config.php';
if(!is_logged_in()){
  redirect('login.php');
}
if(!is_admin()){
  notification('you need to be an admin to login this page','danger');
  redirect('dashboard.php');
}
$user_id = (int)$_POST['user_id'];

if(isset($_POST['delete'])){
  if($user_id===user()['id']){
    notification('you can not delete yourself','danger');
    redirect('users.php');
  }
  $query = "DELETE FROM users WHERE id=:id";
  $stmt  = $db->prepare($query);
  $stmt  ->execute([
    ':id'=> $user_id
  ]);

  notification('user deleted');
  redirect('users.php');
}
