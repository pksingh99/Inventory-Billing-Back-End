<?php
header('Access-Control-Allow-Origin: *');
$startdate=$_GET['startdate'];
$enddate=$_GET['enddate'];
$sid=$_GET['sid'];

$sql="select PID,invoiceNo,invoicedate from purchaseinvoice where invoicedate between '".$startdate."' and '".$enddate."' and SID=".$sid." order by PID desc;";


include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"PID":'.$row["PID"].',"invoiceNo":"'.$row["invoiceNo"].'","invoicedate":"'.$row["invoicedate"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
