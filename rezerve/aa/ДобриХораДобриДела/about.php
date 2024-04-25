<?php
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добри Хора-Добри Дела</title>
  <link rel="stylesheet" href="about.css">
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
  <section class="hero">
    <h1>Добри Хора-Добри Дела 2024</h1>
    <p>
      Сайтът "Добри Хора-Добри Дела", прави своя дебют през 2024 година, той платформа за благотворителност, обединяваща хора и организации с добри намерения.
      <br>Тук се предоставя информация за благотворителни каузи, събития и възможности за участие. 
      <br>Посетителите могат да се включат чрез дарения, доброволческа работа или споделяне на информация.
      <br>Неговите функционалности включват лесна навигация, възможност за регистрация и вход, както и подкрепа за различни благотворителни проекти.</p>

  </section>

  <section class="about">
    <h2>Логото</h2>
    <p>Те тва е</p>
    <img src="img/logo.svg" alt="logo">
  </section>

  <section class="partners">
    <h2>Контакти</h2>
    <div class="partners-items">
      <p>Телефон за връзка: 088 441 2087
        <br><a href="mailto:stevenborisov@gmail.com">Email</a>
      </p>
    </div>
  </section>

  <footer>
    <img src="img/logo.svg" alt="logo">
    <p>Добри Хора-Добри Дела 2024</p>
  </footer>

  <!-- Scroll to top button -->
  <a id="myBtn" class="scrollUp" title="Go to top">
    <img src="img/up.png" alt="">
  </a>

  <script src="main.js"></script>
  
</body>
</html>
