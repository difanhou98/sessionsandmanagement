<?php 
    require("functions.php");
    include("nav.php");
    use_http();
    //specify query and receive results
    $query_str = "SELECT productCode, productName FROM products";
    $res = $connection->query($query_str);
    //echo $_SESSION['valid_user'];
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
    <h1>All Models</h1>
    <?php
    echo "<ul>";
    //echo $product;
    //fetch data for display in <a>
    while ($row = $res->fetch_row()){
        echo "<li>";
        echo "<a class=\"model-link\"href=\"modeldetails.php?product_id=".$row[0] . "\">" . $row[1] . "</a>";
        echo "</li>";
    }   

    echo "</ul>";
    $res->free_result();
    $connection->close();
    ?>
</body>
</html>