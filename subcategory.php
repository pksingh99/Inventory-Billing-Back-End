<?php
header('Access-Control-Allow-Origin: *');
$cid=$_GET['cid'];
$subcategory=$_GET['subcategory'];


include 'connection.php';


$sql = "INSERT INTO subcategory (cid,subcategory)
VALUES ('".$cid."','".$subcategory."');";

if ($con->query($sql) === TRUE) {
    echo '[{"result":true}]';

} else {

echo '[{"result":false}]';
}

$con->close();



?>
