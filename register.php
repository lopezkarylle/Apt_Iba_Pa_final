<?php 
include ("init.php");
use Models\Auth;
session_start();

$last_page = isset($_POST['current_url']) ? $_POST['current_url'] : 'index.php'; //to get last visited page before clicking register

?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<title>Apt Iba Pa</title>
</head>
<body>
    <form id="registration-form" action="register.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <span id="email-error" style="color: red;"></span><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <span id="password-error" style="color: red;"></span><br>

        <label for="confpass">Confirm Password:</label>
        <input type="password" id="confpass" name="confpass" required><br>
        <span id="confpass-error" style="color: red;"></span><br>
        
        <input type="submit" value="Register" id="submit" disabled>
    </form>

    <script>
        const firstNameInput = document.getElementById("first_name");
        const lastNameInput = document.getElementById("last_name");
        const contactNumberInput = document.getElementById("contact_number");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confpassInput = document.getElementById("confpass");
        const submitButton = document.getElementById("submit");

        submitButton.disabled = true;

        firstNameInput.addEventListener("input", validateForm);
        lastNameInput.addEventListener("input", validateForm);
        contactNumberInput.addEventListener("input", validateForm);
        emailInput.addEventListener("input", validateEmail);
        passwordInput.addEventListener("input", validatePassword);
        confpassInput.addEventListener("input", validatePassword);

        function validateForm() {
            if (
                firstNameInput.value &&
                lastNameInput.value &&
                isValidContactNumber(contactNumberInput.value) &&
                isValidEmail(emailInput.value) &&
                isValidPassword(passwordInput.value) &&
                passwordsMatch(passwordInput.value, confpassInput.value)
            ) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        function validateEmail() {
            if (!isValidEmail(emailInput.value)) {
                document.getElementById("email-error").textContent = "Invalid email format";
                submitButton.disabled = true;
            } else {
                document.getElementById("email-error").textContent = "";
                validateForm();
            }
        }

        function validatePassword() {
            if (!isValidPassword(passwordInput.value)) {
                document.getElementById("password-error").textContent = "Password must be at least 8 characters long and contain a number";
                submitButton.disabled = true;
            } else {
                document.getElementById("password-error").textContent = "";
                validateForm();
            }

            if (!passwordsMatch(passwordInput.value, confpassInput.value)) {
                document.getElementById("confpass-error").textContent = "Passwords do not match";
                submitButton.disabled = true;
            } else {
                document.getElementById("confpass-error").textContent = "";
                validateForm();
            }
        }

        // Rest of the validation functions remain the same
        
    </script>
</body>
</html>

<?php
try {
    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $password . $salt);

        $register_user = new Auth('','');
        $register_user->setConnection($connection);
        $register_user = $register_user->registerUser($first_name, $last_name, $contact_number, $email, $hashedPassword, $salt);
        
        $user_auth = $register_user['statement'] ?? null;
        $user_id = $register_user['lastInsertedId'] ?? null;
        $_SESSION['user_id'] = $user_id;

        if($user_auth != NULL && $user_id != NULL){
            header('location:' . $last_page);
            exit();
        }
        else {
            echo '<script>alert("Failed Registration")</script>';
        }

    }
}

catch (Exception $e) {
    
}
?>