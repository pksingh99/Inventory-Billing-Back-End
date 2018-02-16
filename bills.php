<?php
header('Access-Control-Allow-Origin: *');
$item=$_GET['items'];
$totalAmount=$_GET['totalAmount'];
$comments=$_GET['comments'];
$clientname=$_GET['clientname'];
$clientphone=$_GET['clientphone'];
$EID=$_GET['EID'];
$time=$_GET['time'];
$invoicedate=$_GET['invoicedate'];
$data = json_decode($item, TRUE);

include 'connection.php';
mysqli_autocommit($con,FALSE);
$alldone=0;
$notdone=0;
$id=null;
$sql="Insert into invoice (totalAmount,comments,clientname,clientphone,EID,time,invoicedate) value('".$totalAmount."','".$comments."','".$clientname."','".$clientphone."','".$EID."','".$time."','".$invoicedate."');";

if ($con->query($sql) === TRUE) {

$sql1 = "SELECT INID from invoice where INID=(SELECT max(INID) FROM invoice);";
$result1 = $con->query($sql1);
    while($row = $result1->fetch_assoc()) {
$id=$row["INID"];
    }

foreach ($data as &$value) {
$barcode=$value['barcode'];
$description=$value['subcat'];
$rate=$value['rate'];
$gst=$value['gst'];
$amount=$value['amount'];
$quantity=$value['quantity'];
$profit=$value['profit'];

 $sql2="Insert into invoices (INID,barcode,description,rate,gst,amount,quantity,profit) value('".$id."','".$barcode."','".$description."','".$rate."','".$gst."','".$amount."','".$quantity."','".$profit."');";
if ($con->query($sql2) === TRUE) {

  $sql3="update inventory set sold=sold+".$quantity." where EID=".$barcode;
 if ($con->query($sql3) === TRUE) {

 $alldone=1;


 }
$alldone=1;


}
else{
$notdone=1;
mysqli_rollback($con);
}
}
}else{
mysqli_rollback($con);
}

if($notdone==0){
echo '[{"result":"true","message":"all done","invoiceNo":"'.$id.'"}]';
mysqli_commit($con);
}
else{
echo '[{"result":"false","message":"Invoice not saved"}]';
}

$con->close();
?>
