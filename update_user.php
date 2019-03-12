<?php
require_once 'config.php';

if(!is_logged_in()){
  redirect('login.php');
}
if(!is_admin()){
  notification('you need to be an admin to login this page','danger');
  redirect('dashboard.php');
}
$user_id  = (int)trim($_POST['user_id']);
$query    ="SELECT COUNT(id) as is_available FROM users WHERE id=:id";
$stmt     = $db->prepare($query);
$stmt     ->execute([
  ':id'=>$user_id
]);
$user = $stmt ->fetch();
if((int)$user['is_available']===0){
  notification("user with the mention id'.$id.' does not exist",'danger');
  redirect('users.php');
}
if(isset($_POST['edit'])){
  $username = strtolower(trim($_POST['username']));
  $email    =  strtolower(trim($_POST['email']));
  $address  = trim($_POST['address']);
  $active  = trim($_POST['active']);
  $role = trim($_POST['role']);
  $password = trim($_POST['password']);
  if(!empty($password)){
    $password = password_hash($password,PASSWORD_BCRYPT);
    $query = "UPDATE users SET password=:password WHERE id=:id";
    $stmt  =$db->prepare($query);
    $stmt->execute([
      ':password'=>$password,
      ':id'=>$user_id
    ]);
  }

  $query = "UPDATE users SET username=:username,email=:email,address=:address,active=:active,role=:role WHERE id=:id";
  $stmt  =$db->prepare($query);
  $stmt->execute([
    ':username'=>$username,
    ':email'=>$email,
    ':address'=>$address,
    ':active'=>$active,
    ':role'=>$role,
    ':id'=>$user_id
  ]);
  notification('Data updated successfully');
  redirect('users.php');
}
