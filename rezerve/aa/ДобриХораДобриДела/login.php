<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login and Register</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="container">
    <div class="login-form">
      <h2>Login</h2>
      <form id="loginForm" action="login.php" method="post">
        <div class="form-group">
          <label for="loginUsername">Username:</label>
          <input type="text" id="loginUsername" name="loginUsername" required>
        </div>
        <div class="form-group">
          <label for="loginPassword">Password:</label>
          <input type="password" id="loginPassword" name="loginPassword" required>
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
    <div class="register-form">
      <h2>Register</h2>
      <form id="registerForm" action="register.php" method="post">
        <div class="form-group">
          <label for="registerUsername">Username:</label>
          <input type="text" id="registerUsername" name="registerUsername" required>
        </div>
        <div class="form-group">
          <label for="registerEmail">Email:</label>
          <input type="email" id="registerEmail" name="registerEmail" required>
        </div>
        <div class="form-group">
          <label for="registerPassword">Password:</label>
          <input type="password" id="registerPassword" name="registerPassword" required>
        </div>
        <button type="submit">Register</button>
      </form>
    </div>
  </div>
  <script>
    // Redirect after login
    document.getElementById("loginForm").addEventListener("submit", function(event) {
       Redirect to main page after login
       window.location.href = "index.php";
     event.preventDefault(); // Prevent form submission
    });

    // Redirect after registration (Modified to prevent immediate redirection)
    document.getElementById("registerForm").addEventListener("submit", function(event) {
      // Allow the form submission to proceed normally
      // Client-side validation can be added here if needed
      // Note: Redirection after successful registration should be handled in the PHP code
    });
  </script>

<?php
// process_login.php

// Start session
session_start();

// Include database connection file
require_once "dbconn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $username = $_POST["loginUsername"];
  $password = $_POST["loginPassword"];

  try {
      // Query the database to check if the provided credentials are valid
      $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
      if ($stmt) {
          $stmt->execute([$username]);
          $user = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($user && $user['password']==$password) {
              // Set isLoggedIn session variable to true
              $_SESSION['isLoggedIn'] = true;
              $_SESSION['username'] = $user['username'];

              // Redirect to index.php
              header("Location: index.php");
              exit;
          } else {
              // If login fails, redirect to error.html with a message
              header("Location: error.html?error=invalid_credentials");
              exit;
          }
      } else {
          // Handle statement preparation error
          throw new Exception("Failed to prepare statement");
      }
  } catch (Exception $e) {
      // Handle the exception
      error_log('Login error: ' . $e->getMessage());
      header("Location: error.html?error=db_error");
      exit;
  }
}
?>
</body>
</html>
