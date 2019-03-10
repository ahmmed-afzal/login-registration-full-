<?php
require_once 'config.php';
$id = (int)$_SESSION['id'];
$query = "SELECT profile_photo,address FROM users WHERE id=:id";
$stmt  = $db->prepare($query);
$stmt  ->execute([
  ':id'=>$id
]);
$user = $stmt  ->fetch();

if(isset($_POST['edit'])){
  $address = trim($_POST['address']);
  $profile_photo= $_FILES['profile_photo'];
  $file_name=$user['profile_photo'];

  if(! empty($_FILES['profile_photo']['tmp_name'])){
    $old_file ='uploads/'.$file_name;
    $file = uniqid('pp_',true);
    $name_parts = explode('.',$_FILES ['profile_photo']['name']);
    $extension  = end($name_parts);
    $file_name = $file.'.'.$extension;
    move_uploaded_file($_FILES['profile_photo']['tmp_name'], 'uploads/'.$file_name);
    unlink($old_file);
  }
$query = "UPDATE users SET profile_photo=:profile_photo,address=:address WHERE id=:id";
$stmt  = $db->prepare($query);
$stmt  ->bindParam('profile_photo',$file_name);
$stmt  ->bindParam('address',$address);
$stmt  ->bindParam('id',$id);
$stmt  ->execute();

  header('location:edit_profile.php');
  $_SESSION['message'] = "your profile updated successfully";
  exit();
}
