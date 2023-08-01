<?php 
include ("init.php");
use Models\Auth;
session_start();

?>

<div class="container">
  <h3 style="font-weight: bold; text-align: center;">Login</h3><hr><br><br>
  <form method="POST" action="landlord-login.php">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required>
    </div>
    <div class="form-group">
      <a href="forgot-password-owner.php">Lost your Password ? </a> 
    </div>
    <center><input type="submit" id="submit" class="btn btn-primary btn-block" value="Login"></center>
  </form>
</div>

<?php

try {
    if(isset($_POST['email'], $_POST['password'])){
    $user_auth = new Auth();
    $user_auth->setConnection($connection);
    $user_auth = $user_auth->landlordLogin($_POST['email'], $_POST['password']);
    
    $user_id = $user_auth['user_id'] ?? null;
    $user_type = $user_auth['user_type'] ?? null;
    $status = $user_auth['status'] ?? null;

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['status'] = $status;

    if($user_auth != NULL && $user_auth['user_type'] == 1){
        header('location:landlord/index.php');
        exit();
    }
    else if($user_auth != NULL && $user_auth['user_type'] == 3){
        header('location:admin/index.php');
        exit();
    }
    else if($user_auth == NULL || $user_auth['user_type'] == 2){
        echo '<script>alert("Wrong credentials!")</script>';
    }

    }
}

catch (Exception $e) {
    
}
?>

