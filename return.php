<?php
header('Access-Control-Allow-Origin: *');
$invoice =$_GET["invoice"];
$amount =$_GET["amount"];
$barcode =$_GET["barcode"];
$return =$_GET["return"];
$quantity =$_GET["quantity"];

$eachprice=$amount/$quantity;
$rtam=$eachprice*$return;
//echo $purchasedate.$others.$gst.$address.$phone.$name;

include 'connection.php';
mysqli_autocommit($con,FALSE);

if($quantity==$return){
$sql = "delete from invoices where INID=".$invoice." and barcode=".$barcode.";";
$t=0;
if ($con->query($sql) === TRUE) {
  //  echo '[{"result":"true"}]';
$t=1;
} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//echo '[{"result":"false"}]';
mysqli_rollback($con);

}}
else{
  $sql = "update invoices set amount=amount-".$rtam.", quantity=quantity-".$return." where INID=".$invoice." and barcode=".$barcode.";";
  if ($con->query($sql) === TRUE) {
    //  echo '[{"result":"true"}]';
  $t=$t+1;
  } else {
     // echo "Error: " . $sql . "<br>" . $con->error;
  //echo '[{"result":"false"}]';
  mysqli_rollback($con);

  }
}
$sql = "update invoice set totalAmount=totalAmount-".$rtam." where INID=".$invoice.";";

if ($con->query($sql) === TRUE) {
  //  echo '[{"result":"true"}]';
$t=$t+1;
} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//echo '[{"result":"false"}]';
mysqli_rollback($con);

}

$sql = "update inventory set sold=sold-".$return." where EID=".$barcode.";";

if ($con->query($sql) === TRUE) {
  //  echo '[{"result":"true"}]';
$t=$t+1;
} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
//echo '[{"result":"false"}]';
mysqli_rollback($con);

}
if($t==3){
  mysqli_commit($con);
  echo '[{"result":"true"}]';

}
else{

 echo '[{"result":"false"}]';

}
$con->close();

?>
