<?php
require_once 'config.php';
$message = $_SESSION['message']??null;
if(isset($_SESSION['id'],$_SESSION['email'])){
  redirect('dashboard.php');
}
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-2">
      <form action="forgetemail.php" method="post">
        <?php require_once 'layouts/notification.php'; ?>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>

        <button type="submit" class="btn btn-primary" name="forget">Reset password?</button>
        <div>
          <a href="login.php" class="btn btn-warning mt-2">Back</a>
        </div>
      </form>
    </div>
  </div>

</div>
