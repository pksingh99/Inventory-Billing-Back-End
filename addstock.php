<?php

$sql = "update products set instock=instock+".$pquantity." where prodid=".$prodid.";";

if ($con->query($sql) === TRUE) {
    echo '[{"result":"true"}]';

} else {

echo '[{"result":"false"}]';
}




?>
