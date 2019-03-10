<?php
require_once 'config.php';

if(isset($_POST['login'])){
  $email =  strtolower(trim($_POST['email']));
  $password = trim($_POST['password']);

  $query = "SELECT id,password,active,role from users WHERE email=:email";
  $stmt = $db->prepare($query);
  $stmt->bindParam(':email',$email);
  $stmt->execute();
  $user = $stmt->fetch();

  if($user){
    if(password_verify($password,$user['password'])===true){
      if ((bool)$user['active']===false) {

        notification('please Activate your account !','danger');
        redirect('login.php');
      }
      $_SESSION['id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['email'] = $email;
      redirect('dashboard.php');

    }else{
      notification('Invalid Credentials!!','danger');
      redirect('login.php');

    }
  }else{
    notification('user not found!!','danger');
    redirect('login.php');
  }
}

?>
