<?php
header('Access-Control-Allow-Origin: *');
$search=$_GET['search'];
$suppid=$_GET['suppid'];
if(is_numeric($search)){
  $sql="select * from products where (CAST(barcode as CHAR) like '%".$search."%') and company='".$suppid."'";

}else{
$sql="select * from products where (name like '%".$search."%' OR code like '%".$search."%') and company='".$suppid."'";
}

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"prodid":"'.$row["prodid"].'","barcode":"'.$row["barcode"].'","name":"'.$row["name"].'","code":"'.$row["code"].'","category":"'.$row["category"].'","subcategory":"'.$row["subcategory"].'","mrp":'.$row["MRP"].',"srp":'.$row["selling_price"].',"prp":'.$row["purchase_price"].',"company":'.$row["company"].'}';

    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
