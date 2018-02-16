<?php
header('Access-Control-Allow-Origin: *');
$category =$_GET["category"];


//echo $purchasedate.$others.$gst.$address.$phone.$name;

include 'connection.php';


$sql = "INSERT INTO category (category)
VALUES ('".$category."');";

if ($con->query($sql) === TRUE) {
    echo '[{"result":"true"}]';

} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
echo '[{"result":"false"}]';
}

$con->close();

?>
