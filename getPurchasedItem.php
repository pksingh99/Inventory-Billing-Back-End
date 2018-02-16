<?php
header('Access-Control-Allow-Origin: *');

$sid=$_GET['sid'];
$start=$_GET['start'];
$end=$_GET['end'];

$sql="select code,PID,description,srate,purchasedate from newtestinventory where purchasedate between '".$start."' and '".$end."' and SID=".$sid."" ;
echo $sql;

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"code":"'.$row["code"].'","description":"'.$row["description"].'","rate":'.$row["srate"].',"purchasedate":"'.$row["purchasedate"].'","PID":"'.$row["PID"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


 ?>
