<?php if(isset($message)): ?>
  <div class="alert alert-<?php echo $_SESSION['type'];?>">
    <?php echo $message; ?>
  </div>
  <?php unset($_SESSION['message'],$_SESSION['type']) ?>
<?php endif; ?>
