<?php
require_once 'config.php';

if(! isset($_SESSION['id'],$_SESSION['email'])){
  header('location:login.php');
  $_SESSION['message'] = "you need to login";
  exit();
}
if($_SESSION['role']!=='admin'){
  header('location:login.php');
  $_SESSION['message'] = "you need to admin role to access this page";
  exit();
}
$query = "SELECT id,username,email,active FROM users WHERE role='user'";
$stmt = $db->prepare($query);
$stmt ->execute();
$users =$stmt->fetchAll();
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 mt-2">
      <div class="alert alert-info">
        you have been logged in as ,<?php echo $_SESSION['email'];?>
        (<?php echo $_SESSION['role'];?>)
      </div>

      <table class="table table-stripped">
        <thead>
          <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
            <td>Active</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user): ?>
            <tr>
              <td><?= $user['id']; ?></td>
              <td><?= $user['username']; ?></td>
              <td><?= $user['email']; ?></td>
              <td><?= $user['active']== 1?'active':'Inactive'; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <a href="logout.php" class="btn btn-danger mt-2">Logout</a>
    </div>
  </div>
<?php require_once 'layouts/footer.php'; ?>
