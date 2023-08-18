<?php
// Assuming this is the password reset page

// Include necessary files and initialize your database connection

// Check if the reset token and email are provided
if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];

    // Query the database to find a matching token and email
    $query = "SELECT user_id FROM password_reset_tokens WHERE email = ? AND token = ? AND expiry > NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email, $token]);
    $user_id = $stmt->fetchColumn();

    if ($user_id) {
        // Display a form to reset the password
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_password = $_POST['new_password'];

            // Validate and hash the new password
            // You should implement your own password validation and hashing logic
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the user's password in the database
            $update_query = "UPDATE users SET password = ? WHERE id = ?";
            $update_stmt = $pdo->prepare($update_query);
            $update_stmt->execute([$hashed_password, $user_id]);

            // Invalidate the token by deleting it from the database
            $delete_query = "DELETE FROM password_reset_tokens WHERE email = ?";
            $delete_stmt = $pdo->prepare($delete_query);
            $delete_stmt->execute([$email]);

            echo "Password reset successfully!";
        }
        // Display the password reset form
        else {
            echo '
            <form method="POST">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                <button type="submit">Reset Password</button>
            </form>';
        }
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "Invalid request.";
}
?>
