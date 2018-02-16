<?php
header('Access-Control-Allow-Origin: *');
$SID=$_GET['sid'];
$from=$_GET['from'];
$to=$_GET['to'];
$sql="select * from newtestinventory where SID=".$SID." and purchasedate BETWEEN '".$from."' and '".$to."';";

//| PID | SID | description  | quantity | rate | invoiceNo | amount | purchasedate 
include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"PID":"'.$row["PID"].'","SID":"'.$row["SID"].'","description":"'.$row["description"].'","quantity":"'.$row["quantity"].'","rate":"'.$row["rate"].'","invoiceNo":"'.$row["invoiceNo"].'","amount":"'.$row["amount"].'","purchasedate":"'.$row["purchasedate"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
