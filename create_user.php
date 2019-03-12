<?php
require_once 'config.php';
if(!is_logged_in()){
  redirect('login.php');
}
if(!is_admin()){
  notification('you need to be an admin to login this page','danger');
  redirect('dashboard.php');
}
?>
<?php include_once'navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-2">
            <form action="add_user.php" method="post">
                  <?php require_once 'layouts/notification.php'; ?>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>

                <div class="form-group">
                    <label for="username">User name</label>
                    <input type="text" class="form-control" id="username" name="username"  placeholder="Enter username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary" name="register">Add user</button>
                </form>
            </div>
        </div>
