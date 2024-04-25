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
?>
<!doctype html>
<html>

<head>
    <title>FilmHub-explore</title>
    <meta charset="UTF-8">
    <meta name="description" content="Explore page of FilmHub">
    <meta name="keywords" content="movies, series, films, actors, cinema">
    <meta name="author" content="Kristiyan Yordanov 19313">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../Styling/explore.css">
    <link rel="stylesheet" type="text/css" href="../Styling/styling.css">
    <link rel="stylesheet" type="text/css" href="../Styling/header.css">
    <script src="https://kit.fontawesome.com/6a72a76a85.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
    <?php 
    include "../Components/header.html" 
    ?>
    </header>
    <main>
    <h1 class="explore-header">Top rated movies</h1>
<?php

$allMovies = mysqli_query($connection, "SELECT * FROM movie order by rating limit 100");
while ($row = $allMovies->fetch_assoc()){
  ?> 
<div class="container-fluid explore-container ">
<div class="d-md-block d-none">
  <div class="row">
    <div class="col-3">
    <img src="../Images/movie_posters/<?php echo $row["poster"]?>" class="explore-movie-picture" alt="<?php echo $row["title"]."'s poster"?>">
    </div>
    <div class="col-9 text-center">
        <h2><?php echo $row["title"]."-".$row["rating"]?><i class="fa-regular fa-star"></i></h2>
        <p><?php echo $row["synopsis"]?></p>
        <a class="btn btn-outline-light" href="film.php?film=<?php echo $row['id'] ?>">Learn More</a>
    </div>
  </div>
  </div>
  <div class="d-block d-md-none">
  <div class="row row-border exlpore-background-mobile">
  <div class="col" style="text-align:center">
    <img src="../Images/movie_posters/<?php echo $row['poster']?>" class="explore-movie-picture" alt="<?php echo $row["title"]."'s poster"?>">
    </div>
  </div>
  <div class="row text-center">
  <h2><?php echo $row["title"]?></h2>
        <p><?php echo $row["synopsis"]?></p>
        <a class="btn btn-outline-light" href="film.php?film=<?php echo $row['id'] ?>">Learn More</a>
  </div>
  </div>
</div>

<?php
// close while loop 
}
?>
    
</main>
    <br>
    <footer style="position: static; bottom: 0; width: 100%; height: 2.5rem;">
      <?php 
      include "../components/footer.html" ;
      ?>
</footer>
    </body>
</html>