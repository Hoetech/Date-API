<?php 

include 'config.php';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

if($conn) {
    // echo 'Connection Sucessfull';
}
else {
    echo 'An error occured';
}

?>