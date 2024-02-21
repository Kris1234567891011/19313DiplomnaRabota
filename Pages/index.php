<?php
$sname= "localhost";
$uname= "root";
$db_name = "diplomna_rabota";

$connection = new PDO("mysql:host=$sname;dbname=$db_name", $uname);



if (!$connection) {

    echo "Connection failed!";

}

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>FilmHub-Home</title>
        <meta charset="UTF-8">
        <meta name="description" content="FilmHub-Онлайн база данни за филми и сериали">
        <meta name="keywords" content="movies, series, films">
        <meta name="author" content="Kristiyan Yordanov 19313">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../Styling/styling.css">
        <link rel="stylesheet" type="text/css" href="../Styling/header.css">
</head>
<body>

    <header>
            <?php 
            include "../Components/header.html" ;
            ?>
            
    </header>

    <section class="container mt-4">
        <a href="addactor.php">add a page</a>
        <h2 class="mb-4">Featured Movie</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="movie">
                    <img src="movie1.jpg" alt="Movie 1" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="movie-details">
                    <h2>Movie 1 Title</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod justo eu libero congue, id fringilla risus efficitur.</p>
                </div>
            </div>
        </div>

        <h2 class="mt-4 mb-4">Popular Movies</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="movie">
                    <img src="movie2.jpg" alt="Movie 2" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="movie-details">
                    <h2>Movie 2 Title</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod justo eu libero congue, id fringilla risus efficitur.</p>
                </div>
            </div>
        </div>

        <!-- Add more movie entries as needed -->

    </section>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- Your custom JavaScript -->
    <script>
        // You can add JavaScript code for interactivity here
    </script>

</body>
</html>
