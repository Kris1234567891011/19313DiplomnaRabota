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
$user=$_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["review"]) && isset($_POST["rating"])) {
        $review = $_POST["review"];
        $rating = $_POST["rating"];
        if(isset($_SESSION['film_id'])) {
            $film_id = $_SESSION['film_id'];
            $date = date("Y-m-d H:i:s");

            // Prepare SQL statement
            $ureview="INSERT INTO review (Review, Rating, user_id, movie_id, time) 
            VALUES ('$review','$rating','$user','$film_id', '$date')";
		    $result = mysqli_query($connection, $ureview);

            // Execute the statement
            if ( $result ) {
                echo "Review submitted successfully!";
                $movieRating = "Select rating from movie where id = '$film_id'";
                $movieRating = mysqli_query($connection, $movieRating);
                $movieRating = $movieRating->fetch_assoc();
                $movieRating = $movieRating['rating'];
                $numberOfReviews = "Select count(movie_id) as reviews from review where movie_id='$film_id'";
                $numberOfReviews = mysqli_query($connection, $numberOfReviews);
                $numberOfReviews = $numberOfReviews->fetch_assoc();
                $numberOfReviews = $numberOfReviews['reviews'];
                $ratingUpdate = round(($movieRating*$numberOfReviews+$rating)/($numberOfReviews), 1);
                $ratingUpdate = "update movie set rating='$ratingUpdate' where id='$film_id'";
                $change = mysqli_query($connection, $ratingUpdate);
                if ($change){
                    header("Location: ../Pages/film.php?film=$film_id");
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: film_id not found.";
        }
    } else {
        echo "Error: Review cannot be empty.";
    }
} else {
    // Redirect back to the form page if accessed directly
    header("Location: review.php");
    exit();
}
?>
