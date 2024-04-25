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
    <meta name="keywords" content="movies, films, imdb, funstuff">
    <meta name="author" content="Kristiyan Yordanov 19313">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../Styling/explore.css">
    <link rel="stylesheet" type="text/css" href="../Styling/styling.css">
    <link rel="stylesheet" type="text/css" href="../Styling/header.css">
</head>
<body>
    <header>
    <?php 
    include "../Components/header.html" 
    ?>
    </header>
    <main>
      <h1 class="explore-header"> Explore</h1>
<?php

$topRated = mysqli_query($connection, "SELECT * FROM movie order by rating limit 1");
$row = $topRated->fetch_assoc();
$mostRecent = mysqli_query($connection, "SELECT * FROM movie order by productionYear desc limit 1;");
$row2 = $mostRecent->fetch_assoc();
  ?> 
<div class="container-fluid explore-container ">
<div class="d-md-block d-none">
  <div class="row">
    <div class="col-3">
    <img src="../Images/movie_posters/<?php echo $row["poster"]?>" class="explore-movie-picture" alt="<?php echo $row["title"]."'s poster"?>">
    </div>
    <div class="col-9 text-center">
        <h2>Top rated movies</h2>
        <p>The category of "Top Rated Movies" encompasses a curated selection of 
            cinematic masterpieces celebrated for their exceptional storytelling, 
            captivating performances, and enduring impact on audiences worldwide. 
            From timeless classics to contemporary gems, these films have garnered widespread 
            acclaim from critics and viewers alike, earning them a place among the highest 
            echelons of cinematic achievement.</p>
        <a class="btn btn-outline-light" href="toprated.php">Go to category</a>
    </div>
  </div>
  </div>
  <div class="d-block d-md-none">
  <div class="row row-border exlpore-background-mobile">
  </div>
  <div class="row text-center">
  <h1>Top rated movies</h1>
        <p>The category of "Top Rated Movies" encompasses a curated selection of 
            cinematic masterpieces celebrated for their exceptional storytelling, 
            captivating performances, and enduring impact on audiences worldwide. 
            From timeless classics to contemporary gems, these films have garnered widespread 
            acclaim from critics and viewers alike, earning them a place among the highest 
            echelons of cinematic achievement.</p>
        <a class="btn btn-outline-light" href="toprated.php">Go to category</a>
  </div>
  </div>
</div>
<div class="container-fluid explore-container ">
<div class="d-md-block d-none">
  <div class="row">
    <div class="col-3">
    <img src="../Images/movie_posters/<?php echo $row2["poster"]?>" class="explore-movie-picture" alt="<?php echo $row2["title"]."'s poster"?>">
    </div>
    <div class="col-9 text-center">
        <h2>Recently released movies</h2>
        <p> The category of "Recently Released Movies" showcases the latest offerings 
        from the dynamic world of cinema, featuring a diverse array of fresh voices, 
        innovative storytelling techniques, and cutting-edge visual effects. 
        This category provides viewers with an opportunity to stay up-to-date with the newest 
        releases and immerse themselves in the latest trends shaping contemporary filmmaking.</p>
        <a class="btn btn-outline-light" href="mostrecent.php">Go to category</a>
    </div>
  </div>
  </div>
  <div class="d-block d-md-none">
  <div class="row row-border exlpore-background-mobile">
  </div>
  <div class="row text-center">
  <h1>Top rated movies</h1>
        <p>The category of "Top Rated Movies" encompasses a curated selection of 
            cinematic masterpieces celebrated for their exceptional storytelling, 
            captivating performances, and enduring impact on audiences worldwide. 
            From timeless classics to contemporary gems, these films have garnered widespread 
            acclaim from critics and viewers alike, earning them a place among the highest 
            echelons of cinematic achievement.</p>
        <a class="btn btn-outline-light" href="toprated.php">Go to category</a>
  </div>
  </div>
</div>
    
</main>
    <br>
    <footer style="position: static; bottom: 0; width: 100%; height: 2.5rem;">
      <?php 
      include "../components/footer.html" ;
      ?>
</footer>
    </body>
</html>