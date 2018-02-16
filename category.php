<?php
header('Access-Control-Allow-Origin: *');
$category=$_GET['category'];


include 'connection.php';


$sql = "INSERT INTO category (category)
VALUES ('".$category."');";

if ($con->query($sql) === TRUE) {
    echo '[{"result":true}]';

} else {

echo '[{"result":false}]';
}

$con->close();



?>
