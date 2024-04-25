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
$featured = mysqli_query($connection, "SELECT * FROM movie order by rand() limit 1");
$featured = $featured->fetch_assoc();
$featured5 = mysqli_query($connection, "SELECT * FROM movie where id not in ({$featured['id']}) order by rand() limit 5");
$topRated = mysqli_query($connection, "SELECT * FROM movie order by rating desc limit 3");
$director=$featured["director_id"];
$director=mysqli_query($connection, "Select * from director where id = '$director'");
$director=$director->fetch_assoc();
$director=$director["firstName"]." ".$director["lastName"];

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
    <script src="https://kit.fontawesome.com/6a72a76a85.js" crossorigin="anonymous"></script>
</head>
<body>

<header>
    <?php 
    include "../Components/header.html" 
    ?>
    </header>

    <a href="addactor.php">shte poludeq</a>
<div class="container">
    <div class="feature">
        <h1>Featured Movies</h1>
        
        <div id="movieCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" style="border: 3px solid orange; padding-top: 10px">
                <div class="carousel-item active">
                    <a href="film.php?film=<?php echo $featured['id']?>"><img src="../Images/movie_posters/<?php echo $featured['poster']?>" alt="Movie 1" class="img-fluid"></a>
                    <h1><?php echo $featured['title']?></h1>
                    <h5><?php echo $director?></h5>
                    <h5><?php echo $featured['productionYear']?></h5>
                    <h5><?php echo $featured['genre']?></h5>
                    <h5><?php echo $featured["rating"];?><i class="fa-regular fa-star"></i></h5>
                </div>
                <?php while($row=$featured5->fetch_assoc()){
                    $director=$row["director_id"];
                    $director=mysqli_query($connection, "Select * from director where id = '$director'");
                    $director=$director->fetch_assoc();
                    $director=$director["firstName"]." ".$director["lastName"];?>
                <div class="carousel-item">
                    <a href="film.php?film=<?php echo $row['id']?>"><img src="../Images/movie_posters/<?php echo $row['poster']?>" alt="Movie 1" class="img-fluid"></a>
                    <h1><?php echo $row['title']?></h5>
                    <h5><?php echo $director?></h5>
                    <h5><?php echo $row['productionYear']?></h5>
                    <h5><?php echo $row['genre']?></h5>
                    <h5><?php echo $row["rating"];?><i class="fa-regular fa-star"></i></h5>
                </div>
                <?php }?>
            </div>
            <a class="carousel-control-prev" href="#movieCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#movieCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>

<div class="top-rated">
    <h1>Top Rated Movies</h1>
    <div class="movie-list row">
    <?php while($row=$topRated->fetch_assoc()){?>
        <div class="movie col-xs-12 col-lg-3">
            <a href="film.php?film=<?php echo $row['id']?>"><h2><?php echo $row['title'] ?></h2></a>
            <p><?php echo $row['synopsis'] ?></p>
        </div>
        <?php } ?>
    </div>
</div>
<footer style="position: static; bottom: 0; width: 100%; height: 2.5rem;">
      <?php 
      include "../components/footer.html" ;
      ?>
</footer>

<!-- Karosel animacii-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
