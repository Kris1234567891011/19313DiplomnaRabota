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
$film_id=$_GET['film_id'];
$row=mysqli_query($connection, "Select * from movie where id='$film_id'");
$row=$row->fetch_assoc();
$title=$row["title"];
$release=$row["productionYear"];

$director=$row["director_id"];
$director=mysqli_query($connection, "Select * from director where id = '$director'");
$director=$director->fetch_assoc();
$director=$director["firstName"]." ".$director["lastName"];

$reviews=mysqli_query($connection, "Select * from review where movie_id='$film_id' order by time desc")
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
        <link rel="stylesheet" type="text/css" href="../Styling/reviews.css">
        <link rel="stylesheet" type="text/css" href="../Styling/form.css">
</head>
<body>
    <header>
    <?php 
    include "../Components/header.html" 
    ?>
    </header>
    <main>
    <div class="container">
        <h1 class="text-center mb-4"><a class="movie-text" href="film.php?film=<?php echo $film_id?>"><?php echo $title?></a>-Reviews</h1>
        <div class="mb-3">
            <select id="sortMenu" class="custom-select w-auto" onchange="sortReviews()">
                <option value="newest">Sort by Newest</option>
                <option value="oldest">Sort by Oldest</option>
            </select>
        </div>
        <div id="reviewsContainer">
        <?php while ($row = $reviews->fetch_assoc()){?>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="review-card" data-date="<?php echo $row['time']?>">
                    <p><strong>Username:</strong><?php echo $_SESSION['firstName']." ".$_SESSION['lastName']?></p>
                    <div class="stars" data-rating="<?php echo $row['Rating']?>"></div>
                    <p><strong>Review:</strong> <?php echo $row['Review']?></p>
                    <p><strong>Posted on:</strong> <?php echo $row['time']?></p>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        </div>
    </div>
    </main>
    <script>
        function sortReviews() {
        const sortType = document.getElementById('sortMenu').value;
        const reviewsContainer = document.getElementById('reviewsContainer');
        const reviews = reviewsContainer.getElementsByClassName('review-card');
        const reviewsArray = Array.from(reviews);

    if (sortType === 'newest') {
        reviewsArray.sort((a, b) => new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date')));
    } else if (sortType === 'oldest') {
        reviewsArray.sort((a, b) => new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date')));
    }

    // Clear existing reviews
    while (reviewsContainer.firstChild) {
        reviewsContainer.removeChild(reviewsContainer.firstChild);
    }

    // Append sorted reviews
    reviewsArray.forEach(review => reviewsContainer.appendChild(review));
}
    </script>
    <footer style="position: static; bottom: 0; width: 100%; height: 2.5rem;">
      <?php 
      include "../Components/footer.html" ;
      ?>
</footer>
    </body>
</html>
<?php
} else {
    header("Location: register.php");
}
      ?>