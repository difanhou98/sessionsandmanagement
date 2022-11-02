<?php 
include('functions.php');
use_http();
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

$id = trim($_GET['product_id']);
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

// add user/visitor action here
?>
</body>
</html>