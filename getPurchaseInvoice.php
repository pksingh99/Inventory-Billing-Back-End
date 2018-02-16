<?php
header('Access-Control-Allow-Origin: *');
$min=$_GET['min'];
$max=$_GET['max'];

$sql="select * from newtestinventory where PID>=".$min." and PID<=".$max.";";

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'"SID":"'.$row["SID"].'","PID":"'.$row["PID"].'","description":"'.$row["description"].'","quantity":"'.$row["quantity"].'","rate":"'.$row["rate"].'","invoiceNo":"'.$row["invoiceNo"].'","amount":"'.$row["amount"].'","purchasedate":"'.$row["purchasedate"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
