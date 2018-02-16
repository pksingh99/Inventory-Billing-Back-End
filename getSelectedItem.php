<?php
header('Access-Control-Allow-Origin: *');

$pid=$_GET['pid'];

$sql="select SID,description,rate,purchasedate from newtestinventory where PID=".$pid;

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"description":"'.$row["description"].'","rate":'.$row["rate"].',"purchasedate":"'.$row["purchasedate"].'","sid":"'.$row["SID"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


 ?>
