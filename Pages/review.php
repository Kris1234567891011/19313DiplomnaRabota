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
if (isset($_SESSION['user_id'])) {
  $_SESSION['film_id']=$_GET['film_id'];
  $review=mysqli_query($connection, "Select count(*) as 'rows' from review where movie_id='{$_SESSION['film_id']}' and user_id={$_SESSION['user_id']}");
  $review=$review->fetch_assoc();
  if($review['rows']==0){

$row=mysqli_query($connection, "Select * from movie where id='{$_SESSION['film_id']}'");
$row=$row->fetch_assoc();
$title=$row["title"];
$release=$row["productionYear"];

$director=$row["director_id"];
$director=mysqli_query($connection, "Select * from director where id = '$director'");
$director=$director->fetch_assoc();
$director=$director["firstName"]." ".$director["lastName"];
?>
<!doctype html>
<html>

<head>
        <title>FilmHub-Review</title>
        <meta charset="UTF-8">
        <meta name="description" content="FilmHub-Онлайн база данни за филми и сериали">
        <meta name="keywords" content="movies, series, films, actors, cinema">
        <meta name="author" content="Kristiyan Yordanov 19313">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../Styling/styling.css">
        <link rel="stylesheet" type="text/css" href="../Styling/header.css">
        <link rel="stylesheet" type="text/css" href="../Styling/review.css">
        <link rel="stylesheet" type="text/css" href="../Styling/form.css">
</head>
<body>
    <header>
    <?php 
    include "../Components/header.html" 
    ?>
    </header>
    <main>
  <div class="reviewContainer">
    <h1 class="text-center mb-4">Movie Review</h1>
    <div id="movie-details" class="mb-4">
      <h2 class="text-center">Title: <?php echo $title; ?></h2>
      <p class="text-center">Director: <?php echo $director ?> <br> Release Year: <?php echo $release ?></p>
    </div>
    <form action="../Scripts/submit_review.php" method="post" id="review-form">
      <div id="rating-container" class="mb-4">
        <h2 class="text-center">Rate This Movie</h2>
        
<div id="stars">
        <span class="star" data-value="1"></span>
        <span class="star" data-value="2"></span>
        <span class="star" data-value="3"></span>
        <span class="star" data-value="4"></span>
        <span class="star" data-value="5"></span>
        <script src="../Scripts/review.js"></script>
      </div>
      </div>
      <div class="form-group">
        <label for="review">Your Review:</label>
        <textarea id="review" name="review" rows="4" cols="50"></textarea>
      </div>
      <input type="hidden" id="rating" name="rating" value="0">
      <input class="review btn" type="submit" value="Submit Review">
    </form>
  </div>
    </main>
    <footer style="position: static; bottom: 0; width: 100%; height: 2.5rem;">
      <?php 
      include "../Components/footer.html" ;
      ?>
</footer>
    </body>
</html>
<?php
  } else{
    $_SESSION['reviewed']=true;
    header("Location: ../Pages/film.php?film={$_SESSION['film_id']}");
  }
} else {
    header("Location: register.php");
}
      ?>