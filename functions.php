<?php
session_start();
$connection =  connect('localhost', 'root', '', 'classicmodels');

function use_http(){
    if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
        header("Location: http://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }
}
//I tried to use https connection on my localhost but the browser refused the connection saying "This site can’t provide a secure connection" even after I enabled invalid ssl on localhost. 
function use_https() {
	if($_SERVER['HTTPS'] != "on") {
		header("Location: https://" . $_SERVER['HTTP_HOST'] .
			$_SERVER['REQUEST_URI']);
		exit();
	}
}

function connect($dbhost, $dbuser, $dbpass, $dbname) {
    $connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if (mysqli_connect_errno()){
        die(mysqli_connect_error());
    }
    return $connection;
}

function direct_to($url){
    header('Location: ' . $url);
    exit;
}

function is_logged_in(){
    return isset($_SESSION['valid_user']);
}

function is_in_watchlist($product_id){
    global $connection;
    if (isset($_SESSION['valid_user'])){
        $query = "SELECT COUNT(*) FROM watchlist WHERE email=? AND productCode=?";
        $stmt = $connection->prepare($query);
        if ($stmt != false){
            $stmt->bind_param("ss", $_SESSION['valid_user'], $product_id);
            $stmt->execute();
            $stmt->bind_result($count);
            return ($stmt->fetch() && $count > 0);
        }
    }
    if (!empty($stmt)){
    $stmt->free_result();
    }
    return false;
}


?>