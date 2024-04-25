<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// Get the username from the session
$username = $_SESSION['username']; // Assuming you store the username in the session when the user logs in

// Display the profile page
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css"> <!-- Include your CSS file if needed -->
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php">
                    <img src="img/logo.svg" alt="">
                </a>
            </div>
            <p>Добри Хора-Добри Дела</p>
            <div class="nav-menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="charities.php">Charities</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
    </header>

    <main>
        <section class="profile-section">
            <h1>Welcome, <?php echo $username; ?></h1>
            <!-- Display other profile information here if needed -->
            <a href="add_payment.php" class="add-payment-btn">Add Payment</a>
        </section>
        
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>
</body>

</html>
