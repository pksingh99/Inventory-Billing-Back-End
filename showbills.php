<?php
header('Access-Control-Allow-Origin: *');
$INID=$_GET['inid'];
$sql="select * from invoices where INID=".$INID.";";

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"barcode":"'.$row["barcode"].'","description":"'.$row["description"].'","rate":"'.$row["rate"].'","gst":"'.$row["gst"].'","amount":"'.$row["amount"].'","quantity":"'.$row["quantity"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
