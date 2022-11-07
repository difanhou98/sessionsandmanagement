
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


echo "<div class=\"nav-container\"><div class=\"nav-item\">";
echo "<a href=\"showmodels.php\">All Models</a></div>";
echo "<div class=\"nav-item\"><a href=\"showwatchlist.php\">Watchlist</a></div>";
echo "<div class=\"nav-item\">";
        if (!isset($_SESSION['valid_user'])){
            
            echo "<a href=\"login.php\">Log In</a>";
        }
        else{
            echo "<a href=\"signout.php\">Sign Out</a>";
        }       
echo "</div></div>";
?>
