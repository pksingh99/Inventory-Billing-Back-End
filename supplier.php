<?php
header('Access-Control-Allow-Origin: *');
$name =$_GET["name"];
$phone =$_GET["phone"];
$address =$_GET["address"];
$gst =$_GET["gst"];
$others =$_GET["others"];
$sint =$_GET["sint"];


//echo $purchasedate.$others.$gst.$address.$phone.$name;

include 'connection.php';


$sql = "INSERT INTO suppliers (name, phone, address,gstNo,other,sint)
VALUES ('".$name."', '".$phone."', '".$address."','".$gst."','".$others."','".$sint."');";

if ($con->query($sql) === TRUE) {
    echo '[{"result":"true"}]';

} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
echo '[{"result":"false"}]';
}

$con->close();

?>
