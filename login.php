<?php 
include("functions.php");
include("nav.php");
//use_https();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_POST['submit'])){
    $user_email = $user_password = "";
}
else {
    $email = !empty($_POST['email']) ? trim($_POST["email"]) : "";
    $password = !empty($_POST['password']) ? trim($_POST['password']) : "";
    // query
    $query = "SELECT email,password FROM users WHERE email = ?";
    $stmt = $connection->prepare($query);
	$stmt->bind_param('s',$email);
	$stmt->execute();
	$stmt->bind_result($email2,$pass2_hash);
    // verify password and store callback if not logged in
    if($stmt->fetch() && password_verify($password, $pass2_hash)){
        $_SESSION['valid_user'] = $email;
        $callback_url = "index.php";
        if (isset($_SESSION['callback_url'])){
        	$callback_url = $_SESSION['callback_url'];
        }
        direct_to($callback_url);
    }
    else $message = "Sorry, username/password not found";
    $stmt->free_result();
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form class="form-container" action="login.php" method="POST"> 
        <div class="form-item">
            <label for="email">Email: </label>
            <input type="text" id="email" name="email" value="">
        </div>

        <div class="form-item">
            <label for="password">Password: </label>
            <input type="text" id="email" name="password" value="">
        </div>
        <div class="form-item button">
            <input  type="submit" value="submit" name="submit">
        </div>
        <?php 
        if (!empty($message)){
            echo "<p>". $message . "</p>";
        }
        ?>
        <div class="form-item">
            <a class="button" href="register.php">Register Here</a>
        </div>

    </form>
    
</body>
</html>