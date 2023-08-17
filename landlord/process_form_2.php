<?php
// process_form_1.php or process_form_2.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the form data
  $name = $_POST["name"];
  $email = $_POST["email"];

  // Process the data (You can perform database operations or any other required processing here)

  // Return the response
  echo "<p>Form deleted successfully!</p>";
  echo "<p>Name: " . htmlspecialchars($name) . "</p>";
  echo "<p>Email: " . htmlspecialchars($email) . "</p>";
} else {
  echo "Invalid request.";
}
?>
