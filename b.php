<?php 
$item=$_GET['items'];
$data = json_decode($item, TRUE);
foreach ($data as &$value) {
echo $value['description'];
echo $value['rate'];

}

?>
