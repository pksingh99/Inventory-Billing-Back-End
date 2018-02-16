<?php
header('Access-Control-Allow-Origin: *');
$uname=$_GET['uname'];
$upass=$_GET['upass'];

$sql="select name,uname,utype from employees where uname='".$uname."' and upass='".md5($upass)."';";

include 'connection.php';
$result = $con->query($sql);
$str="";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
$str=$str.'{"result":true,"name":"'.$row["name"].'","uname":"'.$row["uname"].'","utype":"'.$row["utype"].'"}';
    }
} else {
  $str= '{"result":false}';
}

$str=str_replace("}{","},{",$str);
$str="[".$str."]";
echo $str;
$con->close();


?>
