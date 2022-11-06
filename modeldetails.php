<?php 
include('functions.php');

use_http();
error_reporting(E_ALL);
ini_set('display_errors',1);
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

$id = $_GET['product_id'];
// echo $id;
$query_str =   "SELECT * 
                FROM products 
                WHERE productCode = ?"; 
$stmt = $connection->prepare($query_str);
$stmt->bind_param('s',$id);
$stmt->execute();
$stmt->bind_result($prCode,$prName,$prLine,$prScale,$prVendor,$prDesc,$prQ,$prPrice,$MSRP);;

if($stmt->fetch()) {
	echo "<h3>$prName</h3>\n";
	echo "<p>Category: $prLine, Scale: $prScale, Vendor: $prVendor, Price: \$$prPrice</p>\n";
	echo "<p>Description: $prDesc</p>\n";
}
$stmt->free_result();

//echo $id;
if (!is_in_watchlist($id)){
    echo "<form action=\"addtowatchlist.php\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"item_to_add\" value=$id>\n";
    echo "<input type=\"submit\" value=\"Add To Watchlist\">";
    echo "</form>";
    $stmt->free_result();
}
else {
    echo "this model has been added into watchlist previously";
}

// echo "<form action=\"addtowatchlist.php\" method=\"POST\">";
// echo "<input type=\"hidden\" name=\"item_to_add\" value=$id>\n";
// echo "<input type=\"submit\" value=\"Add To Watchlist\">";
// echo "</form>";

$stmt->free_result();
$connection->close();
?>
</body>
</html>