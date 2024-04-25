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
if(isset($_SESSION['reviewed'])){
if($_SESSION['reviewed']==true){
  echo "<center style='color:red;'>Film already reviewed</center>";
  $_SESSION['reviewed']=false;
}
}
$film_id=$_GET['film'];
$row=mysqli_query($connection, "Select * from movie where id='{$film_id}'");
$row=$row->fetch_assoc();
$title=$row["title"];
$director=$row["director_id"];
$director=mysqli_query($connection, "Select * from director where id = '$director'");
$director=$director->fetch_assoc();
$director=$director["firstName"]." ".$director["lastName"];
$actors=mysqli_query($connection, "select actor.*, role.roleName from actor join role on actor.id=actor_id join movie on movie.id=movie_id where movie_id='{$film_id}'");
?>
<!doctype html>
<html>

<head>
    <title>FilmHub-explore</title>
    <meta charset="UTF-8">
    <meta name="description" content="Explore page of FilmHub">
    <meta name="keywords" content="usf, uktc, fights, mma, mma promotions">
    <meta name="author" content="Martin Yordanov 19315, Kristiyan Yordanov 19313, Stivan Borisov 19321">
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
<div class="d-md-block d-none container-fluid">
  <div class="row">
    <div class="col-3" style="padding: 50px">
    <div class='fluid-height'>
    <img style="height:30rem; width: 100%;" src="../Images/movie_posters/<?php echo $row["poster"]?>" class="explore-movie-picture img-fluid" alt="<?php echo $row["title"]."'s poster"?>">
</div>  
  </div>
    <div class="col-9">
        <h1 class = "text-center"><?php echo $row["title"];?></h1>
        <h3> Genre: <?php echo $row["genre"];?></h3>
        <h3> Rating: <?php echo $row["rating"];?><i class="fa-regular fa-star"></i>-
        <a class="movie-text" href="review.php?film_id=<?php echo $film_id;?>">Give a review</a>/
        <a class="movie-text" href="reviews.php?film_id=<?php echo $film_id;?>">View reviews</a></h3>
        <h3> Production Year: <?php echo $row["productionYear"];?></h3>
        <h3> Director: <?php echo $director?></h3>
        <h3> Synopsis: </h3>
        <p><?php echo $row["synopsis"]?></p>
        <div class="scroll">
            <?php while ($actor = $actors->fetch_assoc()){?>
              <div class='actors'>
                <img src="../Images/actors/<?php echo $actor['picture_name']?>" style="width: 6rem" alt="<?php echo $actor['firstName']?>">
                <br>
                <h4  style="border-top: orange solid 2px; margin-top: 10px"><?php echo $actor['firstName']?><br><?php echo $actor['lastName']?></h4>
                <p><?php echo $actor['roleName']?></p>
                </div>
            <?php } ?>
        </div>
    
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
  <h1 class = "text-center"><?php echo $row["title"];?></h1>
        <h3> Genre: <?php echo $row["genre"];?></h3>
        <h3> Rating: <?php echo $row["rating"];?><i class="fa-regular fa-star"></i>-
        <a class="movie-text" href="review.php?film_id=<?php echo $film_id;?>">Give a review</a>/
        <a class="movie-text" href="reviews.php?film_id=<?php echo $film_id;?>">View reviews</a></h3>
        <h3> Production Year: <?php echo $row["productionYear"];?></h3>
        <h3> Director: <?php echo $director?></h3>
        <h3> Synopsis: </h3>
        <p><?php echo $row["synopsis"]?></p>
        <div class="scroll">
            <?php while ($actor = $actors->fetch_assoc()){?>
              <div class='actors'>
                <img src="../Images/actors/<?php echo $actor['picture_name']?>" style="width: 6rem" alt="<?php echo $actor['firstName']?>">
                <br>
                <h4  style="border-top: orange solid 2px; margin-top: 10px"><?php echo $actor['firstName']?><br><?php echo $actor['lastName']?></h4>
                <p><?php echo $actor['roleName']?></p>
                </div>
            <?php } ?>
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