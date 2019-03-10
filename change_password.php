<?php
require_once 'config.php';
$message = $_SESSION['message']??null;

if(! isset($_SESSION['id'],$_SESSION['email'])){
  header('location:login.php');
  $_SESSION['message'] = "you need to login";
  exit();
}
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-2">
      <div class="alert alert-info">
        you have been logged in as ,<?php echo $_SESSION['email']; ?>
      </div>

      <?php if(isset($message)): ?>
        <div class="alert alert-info">
          <?php echo $message; ?>
        </div>
        <?php unset($_SESSION['message']); ?>
      <?php endif; ?>
      <form  action="update_password.php" method="post">
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <input type="password" name="current_password" id="current_password" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="new_password">New Password</label>
          <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="confirm_new_password">Confirm New Password</label>
          <input type="password" name="confirm_new_password" id="confirm_new_password" class="form-control" required>
        </div>
        <button type="submit" name="change" class="btn btn-dark">change password</button>
      </form>
      <a href="logout.php" class="btn btn-danger mt-2">Logout</a>
    </div>
  </div>

</div>
