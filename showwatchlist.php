<?php
require("functions.php");

if(!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = 'showwatchlist.php';
	direct_to('login.php');
} 

$email = $_SESSION['valid_user'];
//clear callback_url for future use
if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'showwatchlist.php') {
	unset($_SESSION['callback_url']);
}

$query = "SELECT P1.productCode, P1.productName FROM products P1 INNER JOIN watchlist P2 ON P1.productCode = P2.productCode WHERE P2.email = '$email'";
$res = $connection->query($query);



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
<?php

echo "<ul>";

while ($row = $res->fetch_row()){
    echo "<li>";
    echo "<a href=\"modeldetails.php?product_id=".$row[0] . "\">" . $row[1] . "</a>";
    echo "</li>";
}   

echo "</ul>";
$res->free_result();
$connection->close();
?>
</body>
</html>