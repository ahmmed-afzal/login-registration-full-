<?php
require_once 'config.php';
$message = $_SESSION['message']??null;

if(!is_logged_in()){
  redirect('login.php');
  notification('You need to login to access this page!','danger');
}
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-2">
      <div class="alert alert-warning">
        you have been logged in as ,<?php echo $_SESSION['email'];?>
        (<?php echo $_SESSION['role'];?>)
      </div>
      <div >
          <a href="edit_profile.php" class="btn btn-warning">edit profile</a>
      </div>
        <div >
            <a href="change_password.php" class="btn btn-info mt-2">change password</a>
        </div>
        <?php if($_SESSION['role']==='admin'): ?>
        <div >
            <a href="users.php" class="btn btn-dark mt-2">UserList</a>
        </div>
        <?php endif; ?>
      <a href="logout.php" class="btn btn-danger mt-2">Logout</a>
    </div>
  </div>

<?php require_once 'layouts/footer.php'; ?>
