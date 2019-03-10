<?php
require_once 'config.php';

if(isset($_POST['forget'])){
  $email =  strtolower(trim($_POST['email']));
  $query = "SELECT COUNT(id) as count from users where email=:email";
  $stmt  = $db->prepare($query);
  $stmt->bindParam(':email',$email);
  $stmt->execute();
  $result = $stmt->fetch();
  $email_exist = $result['count'];
  if((bool)$email_exist===true){
    $token = sha1(md5($email.time().uniqid('',true)));
    $query = 'INSERT INTO password_resets(email,token) VALUES(:email,:token)';
    $stmt = $db->prepare($query);
    $stmt->execute([
      ':email'=>$email,
      ':token'=>$token
    ]);
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);                              // Passing `true` enables exceptions
    try {
      //Server settings
      $mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = '1237f575ff4650';                 // SMTP username
      $mail->Password = '5ac57955b9ce40';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('ahmmedafzal4@gmail.com', 'ahmed afzal');
      $mail->addAddress($email);     // Add a recipient

      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Reset password';
      $mail->Body   .= 'Please reset your password by click followed link:</br>';
      $mail->Body   .= '<a href="http://localhost/crud_sumon/reset.php?token='.$token.'">http://localhost/crud_sumon/reset.php?token='.$token.'</a>';
      $mail->Body   .='</br>';

      $mail->send();
    } catch (Exception $e) {
      echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    $_SESSION['message'] = "Please check your email.";
    header('location:login.php');
    exit();
  }
}
