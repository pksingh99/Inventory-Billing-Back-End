<?php
header('Access-Control-Allow-Origin: *');
$name=$_GET['name'];
$barcode=$_GET['barcode'];
$code=$_GET['code'];
$instock=0;
$outstock=0;
$category=$_GET['category'];
$subcategory=$_GET['subcategory'];
$mrp=$_GET['mrp'];
$srp=$_GET['srp'];
$prp=$_GET['prp'];
$company=$_GET['company'];


include 'connection.php';
if($barcode=="generate"){
$sqls="select max(prodid) as prodid from products;";
$results = $con->query($sqls);
$str="";
if ($results->num_rows > 0) {
    // output data of each row
    while($row = $results->fetch_assoc()) {
$barcode=$row["prodid"]+1;
    }
} else {
}
}
if($code=="NA"){
  $code=$barcode;
}

$sql = "INSERT INTO products (name, barcode, code,instock,outstock,category,subcategory,MRP,selling_price,purchase_price,company)
VALUES ('".$name."', '".$barcode."', '".$code."', '".$instock."','".$outstock."','".$category."','".$subcategory."','".$mrp."','".$srp."','".$prp."','".$company."');";

if ($con->query($sql) === TRUE) {
    echo '[{"result":"true"}]';

} else {

echo '[{"result":"false"}]';
}

$con->close();



?>
