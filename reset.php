<?php
require_once 'config.php';
$message = $_SESSION['message']??null;

if(isset($_SESSION['id'],$_SESSION['email'])){
  header('location:dashboard.php');
  exit();
}
$token = trim($_GET['token']);
$query = "SELECT email FROM password_resets WHERE token=:token";
$stmt  = $db->prepare($query);
$stmt ->bindParam(':token',$token);
$stmt ->execute();
$user  =$stmt ->fetch();
if($user===false){
  notification('User not found','danger');
  redirect('login.php');
}
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-2">
      <form action="resetpassword.php" method="post">
        <?php require_once 'layouts/notification.php'; ?>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email"  value="<?= $user['email']; ?>" required readonly>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="reset">Set password</button>
      </form>
    </div>
  </div>
  <?php require_once 'layouts/footer.php'; ?>
