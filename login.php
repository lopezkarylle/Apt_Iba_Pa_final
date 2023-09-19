<?php 
use Models\Auth;
use Models\User;

include ("init.php");
include ("session.php");

$error_message = $_SESSION['login_error'] ?? NULL;
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Apt Iba Pa</title>
    <link rel="stylesheet" href="css/login.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="335062395170-opidtna573omp0n5th3t2q3826slqag9.apps.googleusercontent.com">
    

  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">
            <form method="POST" action="login.php" autocomplete="off" class="sign-in-form">
              <div class="logo">
                <img src="../images/aptlogo.png" alt="" />
                
              </div>

              <div class="signInhead">
              <div class="heading">
                <h2>Welcome</h2>
                <h6>Not registered yet?</h6>
                <a href="#" class="toggle"><b>Sign up</b></a>
              </div>
              </div>

              <div class="signInactfrm">
              <div class="actual-form">
                <span id="email-error" style="color: red;"><?php echo isset($error_message) ? $error_message : ' '?> </span>
                <div  class="input-wrap">
                  <input
                  
                    type="email"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                    oninput="checkEmailValidity()"
                    id="emailLogin"
                    name="email" 
                    
                  />
                  <label >Email</label>
                  <!-- <div id="email-error-login" class="error-message">Invalid email address</div> -->
                </div>

                <div class="input-wrap">
                  <input
                    type="password"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                    id="passwordLogin" 
                    name="password"
                  />
                  <label>Password</label>
                </div>

                <p class="text ">
                  Forgot password?
                  <a href="forgot-password.php" class="resetBtn"><b>Reset Password</b></a>
                </p>

                <input type="submit" value="Sign In" id="loginBtn" class="sign-btn" name="login"  />

                <div class="horizontal-line">
                  <div class="line"></div>
                  <!-- <div class="or-text">or</div> -->
                  <div class="line"></div>
                  </div>
                  
              </div>
              
              </div>
              <!-- <div class="google-text">
                Sign in with Google
                <img class="google-icon" src="https://icons8.com/icon/17949/google" alt="Google Icon">
              </div> -->
              <!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->
            
            </form>
            
            
            
            
            <form action="register.php"  method="POST" autocomplete="off" class="sign-up-form">
              <div  class="logo">
                <img src="resources/images/aptlogo.png" alt=""  />
                
              </div>

              <div class="signUphead">
              <div class="heading">
                <h2>Get Started</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle"><b>Sign in</b></a>
              </div>
              </div>

              <div class="actual-form">
                <div  class="input-wrap">
                  <input
                    type="text"
                    class="input-field"
                    autocomplete="off"
                    id="first_name" 
                    name="first_name"
                    required
                  />
                  <label>First Name *</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="text"
                    class="input-field"
                    autocomplete="off"
                    id="last_name" 
                    name="last_name"
                    required
                  />
                  <label>Last Name *</label>
                </div>

                <div class="input-wrap">
                  <input
                    type="number"
                    id="contact_number"
                    name="contact_number"
                     pattern="[0-9]+"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label for="contact_number">Contact Number *</label>
                </div>
                <span id="contact-error" style="color: red;"></span>

                

                <div class="input-wrap">
                  <input
                    type="email"
                    class="input-field"
                    autocomplete="off"
                    id="email" 
                    name="email"
                    required
                  />
                  <label>Email</label>
                </div>
                <span id="email-error-register" style="color: red;"></span>

                <div class="input-wrap">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label for="password">Password *</label>
                </div>
                <span id="password-error-register" style="color: red;"></span>
                


                <div class="input-wrap">
                  <input
                    type="password"
                    id="confpass" 
                    name="confpass"
                    minlength="4"
                    class="input-field"
                    autocomplete="off"
                    required
                  />
                  <label for="confirm_password">Confirm Password *</label>
                </div>
                <span id="confpass-error" style="color: red;"></span>
                
                <input type="submit" name="register" value="Register" id="registerBtn" class="sign-btn" />

                <div class="signUpline">

                <div class="horizontal-line">
                <div class="line"></div>
                <!-- <div class="or-text">or</div> -->
                <div class="line"></div>
                </div>
                
                </div>
                <!-- <div class="ggl">
                <div class="google-text">
                  Sign in with Google
                  <img class="google-icon" src="https://icons8.com/icon/17949/google" alt="Google Icon">
                </div> -->
              </div>

                
                
              </div>

              
              
            </form>
            
          </div>

          <div  class="carousel">
            <div class="images-wrapper">
              <img src="../images/image1.png" class="image img-1 show" alt="" />
              <img src="../images/image2.png" class="image img-2" alt="" />
              <img src="./img/image3.png" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Look for an accommodation</h2>
                  <h2>Filter your browsing</h2>
                  <h2>Visit and reserve your new home</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript file -->

    <script src="js/login.js"></script>

    <script>
        $(document).ready(function() {
            const firstName = document.getElementById("first_name");
            const lastName = document.getElementById("last_name");
            const contactNumber = document.getElementById("contact_number");
            const email = document.getElementById("email");
            const password = document.getElementById("password");
            const confpass = document.getElementById("confpass");
            const submitButton = document.getElementById("registerBtn");

            submitButton.disabled = true;

            firstName.addEventListener("input", validateUser);
            lastName.addEventListener("input", validateUser);
            contactNumber.addEventListener("input", validateUser);
            email.addEventListener("input", validateUser);
            password.addEventListener("input", validateUser);
            confpass.addEventListener("input", validateUser);

            function validateUser(event) {
            const inputField = event.target;
            let valid = true;

            // Validate first name and last name
            if ((inputField === firstName || inputField === lastName) && (firstName.value === "" || lastName.value === "")) {
                valid = false;
            } else {
                const nameRegex = /^[a-zA-Z]+$/;
                if ((inputField === firstName && !nameRegex.test(firstName.value)) || (inputField === lastName && !nameRegex.test(lastName.value))) {
                valid = false;
                }
            }

            // Validate email
            if (inputField === email) {
                const emailRegex = /^\S+@\S+\.\S+$/;
                if (!emailRegex.test(email.value)) {
                valid = false;
                document.getElementById("email-error-register").textContent = "Email is invalid";
                } else {
                document.getElementById("email-error-register").textContent = "";
                }
            }

            // Validate contact number
            if (inputField === contactNumber) {
                const contactRegex = /^(09|639|\+639)\d{9}$/;
                
                let limit = 11;
                if (contactNumber.value.startsWith("+639")) {
                    limit = 13;
                } else if (contactNumber.value.startsWith("639")) {
                    limit = 12;
                }
                if (contactNumber.value.length > limit) {
                    contactNumber.value = contactNumber.value.slice(0, limit);
                }
                if (!contactRegex.test(contactNumber.value)) {
                valid = false;
                document.getElementById("contact-error").textContent = "Contact number is invalid";
                } else {
                document.getElementById("contact-error").textContent = "";
                }
            }

            // Validate password
            if (inputField === password) {
                const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
                if (!passwordRegex.test(password.value)) {
                    valid = false;
                    document.getElementById("password-error-register").textContent = "Password must be at least 8 characters and contain both letters and numbers";
                } else {
                    document.getElementById("password-error-register").textContent = "";
                }
            }

            // Validate confpass
            if (inputField === confpass) {
                if (confpass.value !== password.value) {
                valid = false;
                document.getElementById("confpass-error").textContent = "Passwords do not match";
                } else {
                document.getElementById("confpass-error").textContent = "";
                }
            }

            // Enable or disable the button based on validity
            submitButton.disabled = !valid;
            }

      
        var emailError = document.getElementById("email-error-register");
        email.addEventListener("input", () => {
            const emailCheck = email.value;
            if (emailCheck.trim() !== "") {
                checkEmailAvailability(emailCheck);
            } else {
                emailError.textContent = "";
            }
        });

            function checkEmailAvailability(emailCheck) {
                // Send an AJAX request to the server to check if the email exists
                // You will need to implement the server-side logic in check_email.php
                fetch("check-email.php", {
                    method: "POST",
                    body: JSON.stringify({ email: emailCheck }),
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.emailExists) {
                        emailError.textContent = "Email already exists.";
                        submitButton.disabled = true;
                    } 
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            }
     });
    </script>
  </body>
</html>

<?php 

try {
    if(isset($_POST['login'], $_POST['email'], $_POST['password'])){
    unset($_SESSION['login_error']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user_auth = new Auth();
    $user_auth->setConnection($connection);
    $user_auth = $user_auth->login($email);

    $current_page = isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 'index.php'; 
    //var_dump($current_page);
    
    
    if($user_auth){
      $salt = $user_auth['salt'];
      $hashedPassword = $user_auth['password'];
      $checkPassword = hash('sha256', $password . $salt);
    
        if ((hash_equals($hashedPassword, $checkPassword))) {
            $user_id = $user_auth['user_id'];
            $_SESSION['user_id'] = $user_id;
            $user = new User('','','','','');
            $user->setConnection($connection);
            $user = $user->getById($user_id);    

            
            
            if($user != NULL && $user['user_type'] == 1) {
                $_SESSION['user_type'] = $user['user_type'];
                echo "<script>window.location.href='landlord/index.php';</script>";
                exit();
            } elseif ($user != NULL && $user['user_type'] == 2) {
              $_SESSION['user_type'] = $user['user_type'];
              echo "<script>window.location.href='$current_page';</script>";
              exit();
            } elseif ($user != NULL && $user['user_type'] == 3) {
              $_SESSION['user_type'] = $user['user_type'];
              echo "<script>window.location.href='admin/index.php';</script>";
              exit();
            } elseif ($user != NULL && $user['user_type'] == 4) {
                $_SESSION['user_type'] = $user['user_type'];
                echo "<script>window.location.href='superadmin/index.php';</script>";
                exit();
            } else {
                $_SESSION['login_error'] = "Your account is not verified. Please contact the admin.";
                echo "<script>window.location.href='login.php';</script>";
            }
            
        } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        echo "<script>window.location.href='login.php';</script>";
        }
    
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        echo "<script>window.location.href='login.php';</script>";
    }
}
}

catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}

?>