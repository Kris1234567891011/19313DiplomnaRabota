<?php
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charities</title>
    <link rel="stylesheet" href="charities.css"> <!-- Include your CSS file if needed -->
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
        <section class="charity">
            <div class="charity-item">
                <img src="charity1.jpg" alt="Charity 1">
                <div class="charity-info">
                    <h2>Charity 1</h2>
                    <p>Description of Charity 1...</p>
                    <a href="donate.php?charity=1">Donate</a>
                </div>
            </div>
            <div class="charity-item">
                <img src="charity2.jpg" alt="Charity 2">
                <div class="charity-info">
                    <h2>Charity 2</h2>
                    <p>Description of Charity 2...</p>
                    <a href="donate.php?charity=2">Donate</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>
</body>

</html>
