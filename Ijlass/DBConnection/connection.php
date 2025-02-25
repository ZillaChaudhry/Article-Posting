<?php
$server = "sql107.infinityfree.com";  // MySQL Host Name
$name = "if0_37725947";               // MySQL User Name
$password = "y6S3dRWKEsIQ";           // MySQL Password
$database = "if0_37725947_db_article"; // MySQL DB Name
$port = "3306";                       // MySQL Port (optional)

// Create connection
$con = new mysqli($server, $name, $password, $database, $port);

// Check connection
if ($con->connect_error) {
    echo "Not Connected: " . $con->connect_error;
} else {
    
}
?>
