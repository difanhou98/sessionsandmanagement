<?php 
    
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
    <form action="submit" method="POST"> 
        <div class="login-item">
            <label for="email">Email: </label>
            <input type="text" id="email" name="user_email" value="<?php echo $email ?>">
        </div>

        <div class="login-item">
            <label for="password">Password: </label>
            <input type="text" id="email" name="user_password" value="">
        </div>

        <input type="submit" value="submit" name="submit">

        <div>
            <a href="register.php">Register Here</a>
        </div>

    </form>
    
</body>
</html>