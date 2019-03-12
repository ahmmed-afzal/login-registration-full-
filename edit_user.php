<?php
require_once 'config.php';
$message = $_SESSION['message']??null;

if(!is_logged_in()){
  redirect('login.php');
}
if(!is_admin()){
  notification('you need to be an admin to login this page','danger');
  redirect('dashboard.php');
}


$id =(int)$_GET['id'];
$query = "SELECT COUNT(id) as is_available, email,username,address,active,role FROM users WHERE id=:id";
$stmt  = $db->prepare($query);
$stmt->execute([
  ':id'=>$id
]);
$user = $stmt ->fetch();
if((int)$user['is_available']===0){
  notification("user with the mention id $id does not exist",'danger');
  redirect('users.php');
}
?>
<?php include_once'navbar.php'; ?>
<div class="container">
  <form action="update_user.php" method="post" class="mt-2">

    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
    <?php require_once 'layouts/notification.php'; ?>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email" name="email"  value="<?php echo $user['email']; ?>" required>
    </div>

    <div class="form-group">
      <label for="username">User name</label>
      <input type="text" class="form-control" id="username" name="username"  value="<?php echo $user['username']; ?>" required>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <textarea name="address" class="form-control"><?php echo $user['address']; ?></textarea>
    </div>
    <div class="form-group">
      <label for="active">Active :</label>
      <input type="radio"  id="active" name="active" <?php if($user['active']==1):echo 'checked';endif; ?> value="1">Yes
      <input type="radio"  id="active" name="active" <?php if($user['active']==0):echo 'checked';endif; ?> value="0">No
    </div>
    <div class="form-group">
      <label for="role">Role</label>
      <select id="role" name="role" class="form-control">
        <option value="user" <?php if($user['active']=='user'):echo 'selected';endif; ?>>User</option>
        <option value="admin"<?php if($user['active']=='admin'):echo 'selected';endif; ?>>Admin</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="edit">Update</button>
  </form>
  <a href="logout.php" class="btn btn-danger mt-2">Logout</a>
</div>
