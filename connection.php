<?php
//header('Access-Control-Allow-Origin: *');

$con = mysqli_connect("localhost","root","root","inventorynew");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else{
//echo "ceonnected";
}
?>
