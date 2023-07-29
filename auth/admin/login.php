<?php 
include ("../../init.php");
use Models\Auth;
//session_start();
// if(isset($_SESSION["email"])){
//   header("location:admin/admin-dasboard.php");
// }

//include("navbar.php");
// include("admin-engine.php");
?>

<div class="container">
  <h3 style="font-weight: bold; text-align: center;">Admin Login</h3><hr><br><br>
  <form method="POST">
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
    <center><input type="submit" id="submit" name="admin_login" class="btn btn-primary btn-block" value="Login"></center>
  </form>
</div>

<?php

try {
    if(isset($_POST['admin_login'], $_POST['email'], $_POST['password'])){
    $admin_auth = new Auth();
    $admin_auth->setConnection($connection);
    $result = $admin_auth->adminLogin($_POST['email'], $_POST['password']);
    
        if(is_null($result)){
            echo '<script>alert("Wrong credentials!")</script>';
            header('location:auth/admin/login.php');

        }
        else{
            
            //$data = $result->fetch_assoc();
            //$logged_user = $data['email'];
            $admin_email = $result['email'] ?? null;
            $_SESSION['email'] = $admin_email;
            //var_dump($admin_email);
            session_start();
            //$_SESSION['email']=$email;
            header('location:../../admin/index.php');
        }
    }
}

catch (Exception $e) {
    
}

// function admin_login(){
// 	global $email,$db;
// 	$email=validate($_POST['email']);
// 	$password=validate($_POST['password']);

// 		$sql = "SELECT * FROM apt_admin where email='$email' AND password='$password' LIMIT 1";
// 		$result = $db->query($sql);
// 		if($result->num_rows==1){
// 			$data = $result-> fetch_assoc();
// 			$logged_user = $data['email'];
// 			session_start();
// 			$_SESSION['email']=$email;

// 		}
// 		else{
			
// ?>

