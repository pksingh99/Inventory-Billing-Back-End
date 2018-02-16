<?php
header('Access-Control-Allow-Origin: *');
$sr=$_GET['sr'];
$sr1=$_GET['sr1'];
$sr=($sr*$sr1);
$sr1=$sr+$sr1;

$sql="select * from inventory where PID>=".$sr." and PID<=".$sr1.";";

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"SID":"'.$row["SID"].'","PID":"'.$row["PID"].'","description":"'.$row["description"].'","quantity":"'.$row["quantity"].'","rate":"'.$row["srate"].'","invoiceNo":"'.$row["invoiceNo"].'","amount":"'.$row["amount"].'","purchasedate":"'.$row["purchasedate"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
