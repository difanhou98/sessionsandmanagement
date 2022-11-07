<?php
include("functions.php");
include("nav.php");

//get product id from modeldetails.php's addtowatchlist button
$productCode = !empty($_POST['item_to_add']) ? $_POST['item_to_add']: "";

if(!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = 'addtowatchlist.php';
	$_SESSION['productCode'] = $productCode;
	direct_to('login.php');
} 

//get user email info to use in later query
$email = $_SESSION['valid_user'];

if (isset($_SESSION['callback_url']) && $_SESSION['callback_url'] == 'addtowatchlist.php') {
	$productCode = $_SESSION['productCode'];
	unset($_SESSION['callback_url'],$_SESSION['productCode']);
    
}
direct_to("showwatchlist.php");
$message = "";
if (!is_in_watchlist($productCode)){
    $query = "INSERT INTO watchlist (email, productCode) VALUES (?,?)";
    $stmt = $connection->prepare($query);
    if ($stmt != false){
        $stmt->bind_param("ss", $email, $productCode);
        $stmt->execute();
        echo "success";
    }
    else {
        echo "failed";
    }
    $message = "saved";
    
}

?>