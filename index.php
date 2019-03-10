<?php
  require_once 'config.php';
  $message = $_SESSION['message']??null;

  if(is_logged_in()){
  header('location:dashboard.php');
  exit();
}
 ?>
<?php include_once'navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mt-2">
            <form action="register.php" method="post">
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
                <div>
                  Already have an account? <a href="login.php" class="btn btn-warning">login here</a>
                </div>
                <button type="submit" class="btn btn-primary" name="register">Register</button>
                </form>
            </div>
        </div>
          <?php require_once 'layouts/footer.php'; ?>
