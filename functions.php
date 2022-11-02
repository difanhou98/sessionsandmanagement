<?php

function use_http(){
    if(isset($_SERVER['HTTPS']) &&  $_SERVER['HTTPS']== "on") {
        header("Location: http://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI']);
        exit();
    }
}

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

session_start();
$connection =  connect('localhost', 'root', '', 'classicmodels');
?>