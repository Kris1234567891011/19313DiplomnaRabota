<?php
$sname= "localhost";
$uname= "root";
$db_name = "diplomna_rabota";

$connection = new PDO("mysql:host=$sname;dbname=$db_name", $uname);



if (!$connection) {

    echo "Connection failed!";

}

session_start(); 
$error = false;

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    if ( empty( $email ) ) {
        $error = true;
        echo "Please, type email<br>";
    }

    if ( empty( $pass ) ) {

        $error = true;
        echo "Please, type pass<br>";
    }

    if ( !$error ) {

        $stmt = $connection->prepare("SELECT * FROM user WHERE email = ?"); 
        $stmt->execute([$email]); 
	    $result = $stmt->fetch();
        echo "zdr";
        

        if (password_verify($pass, $result['password']) ) {
            $row = ($result);
            echo "h ";
        
                $_SESSION['user_id'] = $row['id'];

                $_SESSION['email'] = $row['email'];

                $_SESSION['firstName'] = $row['firstName'];

                $_SESSION['lastName'] = $row['lastName'];

                $_SESSION['admin'] = $row['admin'];

                header("Location: index.php");

                exit();

        }
        else{
            $error=true;
        }

    }
	$email = htmlspecialchars( $email, ENT_QUOTES );
	$pass=htmlspecialchars($pass, ENT_QUOTES);
} if($error){
    echo "Wrong email or password";
    }?>
<!doctype html>
<html lang="en">
<head>
        <title>FilmHub-Login</title>
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
     <h1 style="text-align:center">Sign In</h1>
</div>
</div>
    <div class="form-container">
    
    <form method="post" class="registration-form" enctype="multipart/form-data">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password">

      <input class="btn btn-outline-light btn-outline-light-submit" type="submit" name="submit" value="Log in"> 
    </form>
  </div>
</main>
	</body>
</html>