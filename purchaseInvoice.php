<?php
header('Access-Control-Allow-Origin: *');
$grandPurchaseTotal =$_GET["grandPurchaseTotal"];
$grandSellingTotal =$_GET["grandSellingTotal"];
$comments =$_GET["comments"];
$SID =$_GET["SID"];
$invoiceNo =$_GET["invoiceNo"];
$invoicedate =$_GET["invoicedate"];


//echo $purchasedate.$others.$gst.$address.$phone.$name;

include 'connection.php';


$sql = "INSERT INTO purchaseinvoice (grandPurchaseTotal, grandSellingTotal, comments,SID,invoiceNo,invoicedate)
VALUES ('".$grandPurchaseTotal."', '".$grandSellingTotal."', '".$comments."','".$SID."','".$invoiceNo."','".$invoicedate."');";


if ($con->query($sql) === TRUE) {
    //echo '[{"result":"true"}]';

    $Asql="select max(PID) as PID from purchaseinvoice;";

    include 'connection.php';
    $Aresult = $con->query($Asql);
    $Astr="";
    if ($Aresult->num_rows > 0) {
        // output data of each row
        while($Arow = $Aresult->fetch_assoc()) {
    $Astr=$Astr.'{"PID":'.$Arow["PID"].'}';
        }
    } else {
        echo "0 results";
    }

    $Astr=str_replace("}{","},{",$Astr);
    $Astr="[".$Astr.',{"result":"true"}]';
    echo $Astr;

} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
echo '[{"result":"false"}]';
}

$con->close();

?>
