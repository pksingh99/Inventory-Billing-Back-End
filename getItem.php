<?php
header('Access-Control-Allow-Origin: *');

$barcode=$_GET['barcode'];

$sql="select distinct subcat,srate,description,prate from inventory where barcode='".$barcode."'";

include 'connection.php';
$result = $con->query($sql);
$str="";
$cid=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"subcat":"'.$row["description"].'","rate":'.$row["srate"].',"barcode":"'.$barcode.'","prate":"'.$row["prate"].'","id":"'.$cid.'"}';
$cid++;
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


 ?>
