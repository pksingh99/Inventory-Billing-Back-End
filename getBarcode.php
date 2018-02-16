<?php
header('Access-Control-Allow-Origin: *');
$PID=$_GET['pid'];
$rate;
$sql="select SID,description,srate,purchasedate,SUBSTRING(suppliers.name,1,3) as 'sname'  from newtestinventory inner join suppliers on newtestinventory.SID=suppliers.ID and newtestinventory.PID=".$PID;

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$rate=$row["rate"];
$SID=$row["sname"];
$description=$row["description"];
$purchasedate=$row["purchasedate"];
    }
} else {
    echo "0 results";
}

$sql="select barcode from item where PID=".$PID.";";

$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"barcode":"'.$row["barcode"].'","rate":"'.$rate.'","SID":"'.$SID.'","description":"'.$description.'","purchasedate":"'.$purchasedate.'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;

$con->close();


?>
