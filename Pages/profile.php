<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "diplomna_rabota";

try {
	$connection = mysqli_connect($servername, $username, $password,$database);
	// echo "Connected successfully";
} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
session_start();
$profile = mysqli_query($connection, "Select * from user where id={$_SESSION['user_id']}");
$profile = $profile -> fetch_assoc();
$reviews = mysqli_query($connection, "Select review.* from review join user on user_id = user.id where user.id={$_SESSION['user_id']}")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>FilmHub-explore</title>
    <meta charset="UTF-8">
    <meta name="description" content="Explore page of FilmHub">
    <meta name="keywords" content="usf, uktc, fights, mma, mma promotions">
    <meta name="author" content="Martin Yordanov 19315, Kristiyan Yordanov 19313, Stivan Borisov 19321">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../Styling/styling.css">
    <link rel="stylesheet" type="text/css" href="../Styling/header.css">
    <link rel="stylesheet" type="text/css" href="../Styling/profile.css">
    <script src="https://kit.fontawesome.com/6a72a76a85.js" crossorigin="anonymous"></script>
</head>
<body>

<header>
    <?php 
    include "../Components/header.html" 
    ?>
    </header>
    <div class="container">
    <h1>User Profile-<?php echo $profile['firstName']." ".$profile['lastName']?></h1>
    <div class="profile-info">
        <p><strong>First Name:</strong> <?php echo $profile['firstName']?></p>
        <p><strong>Last Name:</strong> <?php echo $profile['lastName']?></p>
        <p><strong>Email:</strong> <?php echo $profile['email']?></p>
    </div>
    <div class="reviews-container">
        <h4>User Reviews</h4>
        <!-- Example of reviews -->
        <?php while ($row = $reviews->fetch_assoc()){
            $movie = mysqli_query($connection, "Select movie.title from movie join review on movie.id=movie_id where movie.id={$row['movie_id']}");
            $movie = $movie->fetch_assoc();?>
        <div class="review">
            <h2><?php echo $movie['title']?>-<?php echo $row['Rating']?><i class="fa-regular fa-star"></i></h2>
            <p><?php echo $row['Review']?></p>
        </div>
        <?php } ?>
        <!-- Add more reviews as needed -->
    </div>
</div>
<footer style="position: static; bottom: 0; width: 100%; height: 2.5rem;">
      <?php 
      include "../components/footer.html" ;
      ?>
</footer>
</body>
</html>