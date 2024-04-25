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

if ( isset( $_POST['submit'] ) ) {

	// записване на данните от полетата в променливи за по-удобно


	$title = $_POST['title'];
    $movie = $_POST['movie'];
	$actor = $_POST['actor'];

	$error = false;
	
	// изписване на грешка ако не е попълнен модел
	
	if ( !$title ) {
		echo "<center style='color:red;'>Въведете първо име на режисьора</center>";
		$error = true;
	}

	// изписване на грешка ако не е попълнено описание

	if ( !$movie ) {
		echo "<center style='color:red;'>Въведете фамилия име на режисьора</center>";
		$error = true;
	}

    if ( !$actor ) {
		echo "<center style='color:red;'>Въведете фамилия име на режисьора</center>";
		$error = true;
	}


	
	
	if ( !$error ) {

		// INSERT заявка към базата, с която се записват полетата

        $movieInsert="INSERT INTO role (roleName, actor_id, movie_id) 
        VALUES ('$title', '$actor', '$movie')";
		$result = mysqli_query($connection, $movieInsert);
		
		// изписва съобщение, че всичко е минало успешно
		
		if ( $result ) {
			echo "<center style='color:green;'>Режисьора е добавен успешно</center>";
		}
	}
	
	// htmlspecialchars служи да предотврятяване на грешки при въведени "специални" символи в базата.
	
}

?>

<!doctype html>
<html lang="en">
<head>
        <title>FilmHub-Add actor</title>
        <meta charset="UTF-8">
        <meta name="description" content="FilmHub-Онлайн база данни за филми и сериали">
        <meta name="keywords" content="movies, series, films">
        <meta name="author" content="Kristiyan Yordanov 19313">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../Styling/styling.css">
        <link rel="stylesheet" type="text/css" href="../Styling/header.css">
        <link rel="stylesheet" type="text/css" href="../Styling/form.css">
</head>
	  
  <body>
  <header>
      <?php 
      include "../components/header.html" 
      ?>
    </header>
	<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="addactor.php">Add an Actor</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="adddirector.php">Add a director</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="addfilm.php">Add a movie</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="addrole.php">Add a role</a>
  </li>
</ul>

  <form method="post" enctype="multipart/form-data">
	<label>Role Title:</label>
    <input class="form-input" type="text" name="title" value="<?= @$title ?>">
	<label>Movie:</label>
	<select name="movie">
    <?php 
	$allMovies = mysqli_query($connection, "SELECT * FROM movie");
	while ($row = $allMovies->fetch_assoc()){
		?>
		<option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>
		<?php
		// close while loop 
	}
	?>
    </select>
    <label>Actor:</label>
	<select name="actor">
    <?php 
	$allActors = mysqli_query($connection, "SELECT * FROM actor");
	while ($row = $allActors->fetch_assoc()){
		?>
		<option value="<?php echo $row['id']?>"><?php echo $row['firstName']." ".$row['lastName']?></option>
		<?php
		// close while loop 
	}
	?>
    <br><br>
					
	<div class="container-fluid text-center">
    <input class="btn btn-outline-light btn-outline-light-submit" type="submit" name="submit" value="Add"> 
</div>
    </form>
    <br>
  </body>
</html>