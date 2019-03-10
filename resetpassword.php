<?php
require_once 'config.php';
if(isset($_POST['reset'])){
  $email =  strtolower(trim($_POST['email']));
  $password = $_POST['password'];
  $password = password_hash($password,PASSWORD_BCRYPT);
  $query = "UPDATE users SET password=:password WHERE email=:email";
  $stmt     = $db->prepare($query);
  $stmt  ->execute([
    ':email'=>$email,
    ':password'=>$password,
  ]);
  if((bool)$stmt ->rowCount()===true){
    $query = "DELETE FROM password_resets WHERE email=:email";
    $stmt  = $db->prepare($query);
    $stmt  ->execute([
      ':email'=>$email
    ]);
    notification('Password Changed');
    redirect('login.php');
  }notification('Something went wrong!','danger');
  redirect('login.php');
}
