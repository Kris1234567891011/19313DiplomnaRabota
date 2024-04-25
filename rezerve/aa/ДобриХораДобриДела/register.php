<?php
// Start session
session_start();

// Include database connection file
require_once "dbconn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["registerUsername"];
    $email = $_POST["registerEmail"];
    $password = $_POST["registerPassword"];

    // No password hashing for testing purposes
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        // Execute the statement with parameters
        // Insert password in plain text
        $stmt->execute([$username, $email, $password]);

        // Check if insert was successful
        if ($stmt->rowCount() > 0) {
            // Set session variable to indicate user is logged in
            $_SESSION["isLoggedIn"] = true;
            // Redirect user after successful registration
            header("Location: index.php");
            exit;
        } else {
            echo "Registration failed. Please try again.";
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
