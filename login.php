<?php 
use Models\Auth;

include ("init.php");
include ("session.php");

$last_page = isset($_POST['current_url']) ? $_POST['current_url'] : 'index.php'; //to get last visited page before clicking register

$error_message = $_GET['error'] ?? NULL;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<title>Apt Iba Pa</title>
</head>

<body>
<div class="container-fluid">

<div class="container">
  <h3 style="font-weight: bold; text-align: center;">Login</h3><hr><br><br>
  <form method="POST" action="login.php">
  <span id="email-error" style="color: red;"><?php echo isset($error_message)? $error_message : ''?> </span>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
    </div>
    <div class="form-group">
      <a href="forgot-password-owner.php">Forgot your Password ? </a> 
    </div>
    <center><input type="submit" id="submit" class="btn btn-primary btn-block" value="Login" disabled></center>
    <br>
    <div class="form-group">
      Don't have an account yet? <a href="register.php">Register Now</a> 
    </div>
  </form>
</div>

<script>
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const submitButton = document.getElementById("submit");

    submitButton.disabled = true;

    emailInput.addEventListener("input", validateEmail);
    passwordInput.addEventListener("input", validatePassword);
    
    function validateEmail() {
        const emailValue = emailInput.value;
        if (!isValidEmail(emailValue)) {
            submitButton.disabled = true;
        } else {
            toggleSubmitButton();
        }
    }

    function validatePassword() {
        const passwordValue = passwordInput.value;
        if (!isValidPassword(passwordValue)) {
            submitButton.disabled = true;
        } else {
            toggleSubmitButton();
        }
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPassword(password) {
        const passwordRegex = /^(?=.*\d).{8,}$/;
        return passwordRegex.test(password);
    }

    function toggleSubmitButton() {
        if (isValidEmail(emailInput.value) && isValidPassword(passwordInput.value)) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }
</script>
</body>
</body>
</html>


<?php

try {
    if(isset($_POST['email'], $_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    //var_dump($email, $password);
    
    $user_auth = new Auth();
    $user_auth->setConnection($connection);
    $user_auth = $user_auth->login($email);
    
    if($user_auth){
      $salt = $user_auth['salt'];

      $hashedPassword = $user_auth['password'];
      $checkPassword = hash('sha256', $password . $salt);
    
      if ((hash_equals($hashedPassword, $checkPassword)) && $user_auth != NULL && $user_auth['user_type'] == 1) {
          $_SESSION['user_id'] = $user_auth['user_id'];
          $_SESSION['user_type'] = $user_auth['user_type'];
          header('location:landlord/index.php');
          exit();
      } elseif ((hash_equals($hashedPassword, $checkPassword)) && $user_auth != NULL && $user_auth['user_type'] == 2) {
        $_SESSION['user_id'] = $user_auth['user_id'];
        $_SESSION['user_type'] = $user_auth['user_type'];
        header('location:index.php');
        exit();
      } elseif ((hash_equals($hashedPassword, $checkPassword)) && $user_auth != NULL && $user_auth['user_type'] == 0) {
        $_SESSION['user_id'] = $user_auth['user_id'];
        $_SESSION['user_type'] = $user_auth['user_type'];
        header('location:admin/index.php');
        exit();
      } else {
              // echo '<script>alert("Wrong credentials!")</script>';
              $error_message = "Invalid email or password.";
              header('location:login.php?error=' . $error_message);
          }
    } else {
     $error_message = "Invalid email or password.";
     header('location:login.php?error=' . $error_message);
  }
    
    }
}

catch (Exception $e) {
    
}
?>

