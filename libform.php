<?php
header('Access-Control-Allow-Origin: *');
$description =$_GET["description"];
$pquantity =$_GET["pquantity"];
$prate =$_GET["prate"];
$srate =$_GET["srate"];
$code =$_GET["code"];
$stax =$_GET["stax"];
$sid =$_GET["sid"];
$invoiceNo =$_GET["invoiceNo"];
$pamount =$_GET["pamount"];
$samount =$_GET["samount"];
$purchasedate=$_GET["purchasedate"];
$cate =$_GET["cate"];
$scate =$_GET["scate"];
$pidv =$_GET["pidv"];
$prodid=$_GET['prodid'];
$barcode=$_GET['barcode'];
$ptax=$_GET['ptax'];
$eprate=$_GET['eprate'];
$epamount=$_GET['epamount'];


//echo $purchasedate.$amount.$invoiceNo.$rate.$quantity.$description;

include 'connection.php';


$sql = "INSERT INTO inventory (PID,stax,samount,srate,code,category,subcat,description, quantity, prate,invoiceNo,pamount,purchasedate,barcode,ptax,eprate,epamount)
VALUES ('".$pidv."','".$stax."','".$samount."',
'".$srate."',
'".$code."',
'".$cate."',
'".$scate."',
'".$description."',
'".$pquantity."','".$prate."','".$invoiceNo."','".$pamount."','".$purchasedate."','".$barcode."','".$ptax."','".$eprate."','".$epamount."');";



if ($con->query($sql) === TRUE) {
    echo '[{"result":"true"}]';
$i=1;
$id=0;

$sqla = "update products set selling_price=".$srate." and purchase_price=".$prate." and update_date=".$purchasedate." where barcode=".$barcode.";";
if ($con->query($sqla) === TRUE) {
//    echo '[{"result":"true"}]';

} else {

//echo '[{"result":"false"}]';
}

$sqla = "update products set instock=instock+".$pquantity." where prodid=".$prodid.";";
if ($con->query($sqla) === TRUE) {
//    echo '[{"result":"true"}]';

} else {

//echo '[{"result":"false"}]';
}



$sql1 = "SELECT EID FROM inventory where EID=(SELECT max(EID) FROM inventory);";
$result1 = $con->query($sql1);

if ($result1->num_rows > 0) {
    // output data of each row
    while($row = $result1->fetch_assoc()) {
$id=$row["EID"];
    }
} else {
    echo "0 results";
}


while ($i<=$pquantity)
{
$sql2="Insert into item (EID) value('".$id."');";
if ($con->query($sql2) === TRUE) {

  //echo '[{"result":"true"}]';


}
  $i++;
}


} else {
   // echo "Error: " . $sql . "<br>" . $con->error;
echo '[{"result":"false"}]';
}

$con->close();

?>
