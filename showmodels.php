<?php 
    require("db.php");
    $connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if (mysqli_connect_errno()){
        die(mysqli_connect_error());
    }

    //specify query and receive results
    $product_name_query = "SELECT productName FROM products";
    $product_name_result = mysqli_query($connection, $product_name_query);

    if (!$product_name_result){
        die("Query Failed");
    }

    if (mysqli_num_rows($product_name_result) != 0){
        while ($row = mysqli_fetch_assoc($product_name_result)){
            $product_name[] = $row['productName'];
        }
    }
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
    <h1>All Models</h1>
    <?php
        echo "<table>";

        foreach ($product_name as $product){
            //echo $product;
            echo "<tr><td>";
            echo "<a href=\"modeldetails.php?product_id=". $product . "\">" . $product . "</a>";
            echo "</td></tr>";
        }

        echo "</table>";
    ?>
</body>
</html>