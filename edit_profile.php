<?php
require_once 'config.php';
$message = $_SESSION['message']??null;

if(! isset($_SESSION['id'],$_SESSION['email'])){
    redirect('login.php');
    notification('You need to login to access this page!','danger');
}
$id = (int)$_SESSION['id'];
$query = "SELECT profile_photo,address FROM users WHERE id=:id";
$stmt  = $db->prepare($query);
$stmt  ->execute([
    ':id'=>$id
]);
$user = $stmt  ->fetch();
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <div class="row">
    <div class="col-md">
      <div class="alert alert-info">
        you have been logged in as ,<?php echo $_SESSION['email']; ?>
        (<?php echo $_SESSION['role'];?>)
      </div>
      <div >
        <form action="update_profile.php" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label for="profile_photo">Photo:</label>
            <input type="file" name="profile_photo" class="form-control">
            <?php if(!empty($user['profile_photo'])): ?>
            <img src="uploads/<?= $user['profile_photo']; ?>" width="200" height="150" alt="profile photo">
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="address">Address:</label>
              <textarea name="address" class="form-control"><?=$user['address']; ?></textarea>
          </div>

          <button type="submit" class="btn btn-primary" name="edit">Update</button>
        </form>
        <a href="logout.php" class="btn btn-danger mt-2">Logout</a>
      </div>
    </div>

  </div>
