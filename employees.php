<?php
header('Access-Control-Allow-Origin: *');
$name=$_GET['name'];
$address=$_GET['address'];
$phone=$_GET['phone'];
$uname=$_GET['uname'];
$upass=$_GET['upass'];
$utype=$_GET['utype'];


include 'connection.php';


$sql = "INSERT INTO employees (name, phone, address,uname,upass,utype)
VALUES ('".$name."', '".$phone."', '".$address."', '".$uname."', '".md5($upass)."', '".$utype."');";

if ($con->query($sql) === TRUE) {
    echo '[{"result":"true"}]';

} else {

echo '[{"result":"false"}]';
}

$con->close();



?>
