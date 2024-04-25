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


	$fName = $_POST['fName'];
    $lName = $_POST['lName'];
    
    $file = $_FILES['picture'];
	$file_name = $_FILES['picture']['name'];
	$file_temp = $_FILES['picture']['tmp_name'];
	$file_type = $_FILES['picture']['type'];

	$error = false;
	
	// изписване на грешка ако не е попълнен модел
	
	if ( !$fName ) {
		echo "<center style='color:red;'>Въведете първо име на актьора</center>";
		$error = true;
	}

	// изписване на грешка ако не е попълнено описание

	if ( !$lName ) {
		echo "<center style='color:red;'>Въведете фамилия име на актьора</center>";
		$error = true;
	}
    if ( $file_type != "image/png" && $file_type != "image/jpeg" ) {
		
		echo "<center style='color:red;'>Качете снимка</center>";
		$error = true;
		
	} else {
		
		// завършване на upload-а и записване на качения файл в папка images
	
		move_uploaded_file( $file_temp, "../Images/actors/".$file_name );
	}

	
	
	if ( !$error ) {

		// INSERT заявка към базата, с която се записват полетата

        $actorInsert="INSERT INTO actor (firstName, lastName, picture_name) 
        VALUES ('$fName','$lName','$file_name')";
		    $result = mysqli_query($connection, $actorInsert);
		
		// изписва съобщение, че всичко е минало успешно
		
		if ( $result ) {
			echo "<center style='color:green;'>Актоьрът е добавен успешно</center>";
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
    <a class="nav-link active" aria-current="page" href="addactor.php">Add an Actor</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="adddirector.php">Add a director</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="addfilm.php">Add a movie</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="addrole.php">Add a role</a>
  </li>
</ul>

  <form method="post" enctype="multipart/form-data">
	<label>First Name:</label>
    <input class="form-input" type="text" name="fName" value="<?= @$fName ?>">
    <label>Last Name:</label>
    <input class="form-input" type="text" name="lName" value="<?= @$lName ?>">
	<label>Picture:</label>
	<input class="form-input" type="file" name="picture">
    <br><br>
					
	<div class="container-fluid text-center">
    <input class="btn btn-outline-light btn-outline-light-submit" type="submit" name="submit" value="Add"> 
</div>
    </form>
    <br>
  </body>
</html>