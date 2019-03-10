<?php
require_once 'config.php';

$id = (int)$_SESSION['id'];
if(isset($_POST['change'])){
  $current_password = trim($_POST['current_password']);
  $new_password = trim($_POST['new_password']);
  $confirm_new_password = trim($_POST['confirm_new_password']);


  $query = "SELECT password from users where id=:id";
  $stmt  = $db->prepare($query);
  $stmt  ->execute([
    ':id'=>$id
  ]);
  $user = $stmt  ->fetch();
  if(password_verify($current_password,$user['password'])===true){
    if($new_password===$confirm_new_password){
      $new_password = password_hash($new_password,PASSWORD_BCRYPT);
      $query ="UPDATE users set password=:password WHERE id=:id";
      $stmt = $db->prepare($query);
      $stmt ->execute([
        ':password'=>$new_password,
        ':id'      =>$id
      ]);
      notification('password changed');
      redirect('dashboard.php');
    }else {
      notification('new_password and confirm_new_password does not match','danger');
      redirect('change_password.php');

    }
  }else{
    notification('Invalid password','danger');
    redirect('change_password.php');
  }
}
