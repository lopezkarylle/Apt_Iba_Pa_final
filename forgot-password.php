<?php
use Models\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include ("init.php");
include ("session.php");

$mail = new PHPMailer;

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $user = new Auth();
    $user->setConnection($connection);
    $user = $user->login($email);

    
    if ($user) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32)); // Generate a 64-character token

        // Insert the token and email into the password_reset_tokens table
        $reset_token = new Auth();
        $reset_token->setConnection($connection);
        $reset_token = $reset_token->resetToken($email, $token);

        //var_dump($reset_token);
        
        // Send the reset link to the user's email
        $reset_link = "https://localhost/Apt_Iba_Pa/reset-password.php?token=$token&email=$email";

        // You should use a proper email library to send emails, like PHPMailer or similar
        //$subject = "Password Reset";
        $message = "To reset your password, click on the following link:\n\n$reset_link";
        //mail($email, $subject, $message);

        $mail = new PHPMailer();

        $mail->isSMTP(); 
        $mail->SMTPAuth = true;

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'sia.yabut.micohjomarie@gmail.com';
        $mail->Password = 'chocoboyabut8';

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('sia.yabut.micohjomarie@gmail.com', 'Apt Iba Pa');
        $mail->addAddress($email, 'User');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset Password Link';
        $mail->Body    = "To reset your password, click on the following link:\n\n$reset_link";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        if ($mail->send()) {
            echo 'Email sent successfully!';
        } else {
            echo 'Email sending failed: ' . $mail->ErrorInfo;
        }   

        //echo "Password reset link sent to your email.";
    } else {
        echo "Email not found.";
    }
}
?>

<!-- HTML form for the login page -->
<form method="POST" action="forgot-password.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Reset Password</button>
</form>
