<?php
header('Access-Control-Allow-Origin: *');
$INID=$_GET['inid'];
$sql="select totalAmount,clientname,clientphone,EID from invoice where INID=".$INID.";";

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"totalAmount":"'.$row["totalAmount"].'","clientname":"'.$row["clientname"].'","clientphone":"'.$row["clientphone"].'","EID":"'.$row["EID"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
