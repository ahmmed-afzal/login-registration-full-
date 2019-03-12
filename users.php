<?php
require_once 'config.php';

if(! is_logged_in()){
  notification('you need to login','danger');
  direct('login.php');
}
if(!is_admin()){
  notification('you need to be an admin to login this page','danger');
  redirect('login.php');
}
$query = "SELECT id,username,email,active FROM users ";
$stmt = $db->prepare($query);
$stmt ->execute();
$users =$stmt->fetchAll();
$message = $_SESSION['message']??null;
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md mt-2">
      <div class="alert alert-info">
        you have been logged in as ,<?php echo $_SESSION['email'];?>
        (<?php echo $_SESSION['role'];?>)
      </div>
      <?php require_once 'layouts/notification.php'; ?>
      <a href="create_user.php" class="btn btn-success">Create User</a>
      <table class="table table-stripped table-hover mt-2">
        <thead>
          <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
            <td>Active</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach($users as $user): ?>
            <tr>
              <td><?= $user['id']; ?></td>
              <td><?= $user['username']; ?></td>
              <td><?= $user['email']; ?></td>
              <td><?= $user['active']== 1?'active':'Inactive'; ?></td>
              <td>
                <a href="edit_user.php?id=<?= $user['id']; ?>" class="btn btn-dark">Edit</a>
                <form class="mt-2" action="delete_user.php" method="POST">
                  <input type="hidden" name="user_id" value=<?= $user['id']; ?>>
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');" name="delete">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <a href="logout.php" class="btn btn-danger mt-2">Logout</a>
    </div>
  </div>
  <?php require_once 'layouts/footer.php'; ?>
