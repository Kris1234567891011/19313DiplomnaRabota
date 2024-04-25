<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добри Хора-Добри Дела</title>
  <link rel="stylesheet" href="index.css">
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
          <!-- Updated navigation link for login -->
          <?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>
            <!-- If user is logged in, display "Profile" and "Logout" -->
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php else: ?>
            <!-- If user is not logged in, display "Login" -->
            <li><a href="login.php">Login</a></li>
          <?php endif; ?>
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
    <section class="program">
      <h1>Добре дошли! <br> Нашият сайт има за цел да помага на хора/деца в нужда, животни и на околната среда.</h1>
    </section>
    <section class="staff">
    <div class="dropdown">
        <button class="dropdown-btn">Направи дарение</button>
        <div class="dropdown-content">
            <a href="#people">Хора</a>
            <a href="#animals">Животни</a>
            <a href="#environment">Околна среда</a>
        </div>
    </div>

   
    <div class="image-display">
      <img src="img/img1.jpg" alt="Display Image">
    </div>
    
    <div class="image-display">
      <img src="img/img2.jpg" alt="Display Image">
    </div>
    
    <div class="image-display">
      <img src="img/img3.jpg" alt="Display Image">
    </div>

    <section id="people">
    <h2>Дарения за Хора</h2>
    <p></p>
</section>

<section id="animals">
    <h2>Дарения за Животни</h2>
    <p>Information about donations for animals...</p>
</section>

<section id="environment">
    <h2>Дарения за Околната Среда</h2>
    <p>Information about donations for the environment...</p>
</section>
    </section>
  
  </main>

  <!-- Footer -->
 

  <!-- Image Display Area -->
 
  
  <script>
    const images = ['img/img1.jpg', 'img/img2.jpg', 'img/img3.webp', 'img/img3a.jpg', 'img/img4.jpg', 'img/img5.jpeg', 'img/img6.jpg', 'img/img7b.jpg', 'img/img8.jpg', 'img/img9b.jpg'];
    let currentImage = 0;
    const imageElements = document.querySelectorAll('.image-display img');

    function changeImage() {
      imageElements.forEach((img, index) => {
        img.src = images[(currentImage + index) % images.length];
      });
      currentImage = (currentImage + 1) % images.length;
    }

    setInterval(changeImage, 3000);
  </script>
    <script>
    // Check if user is logged in based on session variable
    <?php
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>
        // Find the login link by its href attribute
        const loginLink = document.querySelector('a[href="login.php"]');
        if (loginLink) {
            // Change the href attribute to profile.html
            loginLink.href = "profile.php";
            // Change the link text to "Profile"
            loginLink.textContent = "Profile";
        }
    <?php endif; ?>
</script>
</body>

</html>
