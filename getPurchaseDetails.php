<?php
header('Access-Control-Allow-Origin: *');

$PID=$_GET['pid'];

//$sql="select inventory.invoiceNo,barcode,replace(SUBSTRING(invoicedate,1,7),'-','') as invoicedate,item.EID as EEID,inventory.PID,sint as si,code,description,srate from item,inventory,purchaseinvoice,suppliers where inventory.PID=purchaseinvoice.PID and suppliers.ID=purchaseinvoice.SID and inventory.EID=item.EID and purchaseinvoice.PID=".$PID;
$sql="select * from suppliers,inventory,purchaseinvoice where purchaseinvoice.PID=inventory.PID and suppliers.ID=purchaseinvoice.SID and inventory.PID=".$PID;

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $str=$str.'{"quantity":"'.$row["quantity"].'","invoiceNo":"'.$row["EID"].'","barcode":"'.$row["EID"].'","rate":"'.$row["srate"].'","SID":"'.$row["sint"].'","description":"'.$row["description"].'","purchasedate":"'.$row["invoicedate"].'","EID":"'.$row["EEID"].'","code":"'.$row["code"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
