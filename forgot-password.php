<?php
// Assuming this is the login page

// Include necessary files and initialize your database connection

// Check if the user has submitted the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $user_id = $stmt->fetchColumn();

    if ($user_id) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32)); // Generate a 64-character token

        // Insert the token and email into the password_reset_tokens table
        $insert_query = "INSERT INTO password_reset_tokens (email, token, expiry) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))";
        $insert_stmt = $pdo->prepare($insert_query);
        $insert_stmt->execute([$email, $token]);

        // Send the reset link to the user's email
        $reset_link = "https://yourwebsite.com/reset-password.php?token=$token&email=$email";

        // You should use a proper email library to send emails, like PHPMailer or similar
        $subject = "Password Reset";
        $message = "To reset your password, click on the following link:\n\n$reset_link";
        mail($email, $subject, $message);

        echo "Password reset link sent to your email.";
    } else {
        echo "Email not found.";
    }
}
?>

<!-- HTML form for the login page -->
<form method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Login</button>
</form>

<!-- Forgot Password link -->
<p><a href="forgot-password.php">Forgot Password?</a></p>
