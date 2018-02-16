<?php
header('Access-Control-Allow-Origin: *');
$barcode=$_GET['barcode'];
$sql="select barcode from invoices where barcode=".$barcode;

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"barcode":true}';
//this is not needed now so true
    }
} else {
  $str=$str.'{"barcode":true}';
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
