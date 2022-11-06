<?php
require('functions.php');

//use_https();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['submit'])){
    $fname = !empty($_POST["fname"]) ? trim($_POST["fname"]) : "";
    $lname = !empty($_POST["lname"]) ? trim($_POST["lname"]) : "";
    $email = !empty($_POST["email"]) ? trim($_POST["email"]) : "";
    $password = !empty($_POST["password"]) ? $_POST["password"] : "";
    $password2 = !empty($_POST["password2"]) ? $_POST["password2"] : "";
    if ($password != $password2){
        $message = "password you entered do not matched, please try again";
    }
    // else if(!$fName || !$lName || !$email || !$password || !$password2){
    //     $message = "Please fill out all fields";
    // }
    else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(email, password, fname, lname) ";$query .="VALUES (?,?,?,?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('ssss', $email, $password_hash, $fname, $lname);
        // query validation: https://stackoverflow.com/questions/26751296/mysqli-prepare-statement-insert-not-inserting
        if(!$stmt->execute()){trigger_error("there was an error....".$connection->error, E_USER_WARNING);}
        $stmt->free_result();
        $_SESSION['valid_user'] = $email;
        //echo $query;
        $callback_url = "index.php";
        if (isset($_SESSION['callback_url']))
        	$callback_url = $_SESSION['callback_url'];
        //switch back to non-secure http
        direct_to($callback_url);
    }
    
}
else{
    $fname = "";
    $lname = "";
    $email = "";
    $password = "";
    $password2 = "";
}

$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Account Registeration</h1>
    <form action="register.php" method="POST">
        <label for="fname">First Name: <input name="fname" type="text" value="<?php $fname ?>"></label>
        <br/>
        <label for="lname">Last Name: <input type="text" name="lname" value="<?php $lname ?>"></label>
        <br/>
        <label for="email">Email Address: <input type="email" name="email" value="<?php $email ?>"></label>
        <br/>
        <label for="password">Password: <input type="password" name="password" value=""></label>
        <br/>
        <label for="password2">Confirm Password: <input type="password" name="password2" value=""></label>
        <br/>
        
        <input type="submit" name="submit" value="Register">
        <?php if(!empty($message)) echo '<p>' . $message . '</p>' ?>
    </form>
</body>
</html>