<?php
require_once 'config.php';
if(!is_logged_in()){
  redirect('login.php');
}
if(!is_admin()){
  notification('you need to be an admin to login this page','danger');
  redirect('dashboard.php');
}
if(isset($_POST['register'])){
$username = strtolower(trim($_POST['username']));
$email =  strtolower(trim($_POST['email']));
$password = $_POST['password'];
$password = password_hash($password,PASSWORD_BCRYPT);
$activation_token = sha1(uniqid($username.$email.time(),true));

$query = 'INSERT INTO users (username,email,password,activation_token) VALUES (:username,:email,:password,:activation_token)';
$stmt = $db->prepare($query);
$stmt->bindParam(':username',$username);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':password',$password);
$stmt->bindParam(':activation_token',$activation_token);
//$stmt->bindValue(':activation_token',date(Y-m-d));
$response = $stmt->execute();

if($response === true){
  $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
  try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '1237f575ff4650';                 // SMTP username
    $mail->Password = '5ac57955b9ce40';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ahmmedafzal4@gmail.com', 'ahmed afzal');
    $mail->addAddress($email, $username);     // Add a recipient

    $mail->isHTML();                                  // Set email format to HTML
    $mail->Subject = 'Account Created As'.$username;
    $mail->Body    = 'Dear '.$email.',</br>';
    $mail->Body   .= 'Your Account Created Successfully! </br>';
    $mail->Body   .= 'Please activate your account by click followed link:</br>';
    $mail->Body   .= '<a href="http://localhost/crud_sumon/activate.php?token='.$activation_token.'">http://localhost/crud_sumon/activate.php?token='.$activation_token.'</a>';
    $mail->Body   .='</br>';

    $mail->send();

  } catch (\Exception $e) {

  }
  notification('User Account Created');
  redirect('users.php');
}else{
  notification('Something went wrong!please try again.','danger');
  redirect('users.php');

    }
}
