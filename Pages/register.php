<?php
try {
	$connection = new PDO("mysql:host=localhost;dbname=diplomna_rabota", "root");
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

if ( isset( $_POST['submit'] ) ) {


	$fName = $_POST['fName']; 
	$lName = $_POST['lName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordC = $_POST['passwordC'];

	

	$error = false;


  if( !($fName) ){
        echo "<center style='color:red;'>Please enter your first name</center>";
		$error = true;
    }

	if ( !$lName ) {
		echo "<center style='color:red;'>Please enter your last name</center>";
		$error = true;
	}
	
	
	if ( !$email ) {
		echo "<center style='color:red;'>Please enter your email</center>";
		$error = true;
	}

	if ( !$password ) {
		echo "<center style='color:red;'>Please enter a password</center>";
		$error = true;
	}

	if($passwordC!=$password){
		echo "<center style='color:red;'>The passwords do not match</center>";
		$error=true;
	}
	$stmt = $connection->prepare("SELECT * FROM user WHERE email = ?"); 
        $stmt->execute([ $email]); 
	    $result = $stmt->fetch();
	if ($result) {
		echo "Error";
		$error=true;
	}


	
	
	
	if ( !$error ) {
		$sql = "INSERT INTO user (firstName, lastName, email, password) VALUES (?,?,?,?)";
		$result = $connection->prepare($sql)->execute([$fName, $lName, $email, password_hash($password, PASSWORD_DEFAULT)]);
		
		
		if ( $result ) {
            header("Location: login.php");
		}
	} 
	
	
	$fName = htmlspecialchars( $fName, ENT_QUOTES );
	$lName = htmlspecialchars( $lName, ENT_QUOTES );
	$email = htmlspecialchars( $email, ENT_QUOTES );
	$password=htmlspecialchars($password, ENT_QUOTES);
    $passwordC=htmlspecialchars($passwordC, ENT_QUOTES);
}

?>
<!doctype html>
<html lang="en">
<head>
        <title>FilmHub-Registration</title>
        <meta charset="UTF-8">
        <meta name="description" content="FilmHub-Онлайн база данни за филми и сериали">
        <meta name="keywords" content="movies, series, films">
        <meta name="author" content="Kristiyan Yordanov 19313">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../Styling/styling.css">
        <link rel="stylesheet" type="text/css" href="../Styling/header.css">
        <link rel="stylesheet" type="text/css" href="../Styling/register.css">
</head>
  <body>
    <header>
      <?php 
      include "../components/header.html" 
      ?>
    </header>
    <main>
    <div class="row register-form-heading">
    <div class="d-md-block d-none">
     <h1 style="text-align:center">Sign Up</h1>
</div>
</div>
    <div class="form-container">
    
    <form method="post" class="registration-form" enctype="multipart/form-data">
      <label for="fName">First Name:</label>
      <input type="text" id="fName" name="fName" placeholder="Enter your first name">

      <label for="lName">Last Name:</label>
      <input type="text" id="lName" name="lName" placeholder="Enter your last name">

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password">

      <label for="passwordC">Confirm Password:</label>
      <input type="password" id="passwordC" name="passwordC" placeholder="Confirm your password">

      <input class="btn btn-outline-light btn-outline-light-submit" type="submit" name="submit" value="Register"> 
    </form>
  </div>
</main>
	</body>
</html>

