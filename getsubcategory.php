<?php
header('Access-Control-Allow-Origin: *');
$category=$_GET[category];
$sql="select subcategory,id from subcategory where cid=(select id from category where category='".$category."');";

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"ID":"'.$row["id"].'","name":"'.$row["subcategory"].'"}';
    }
} else {
    echo "0 results";
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
