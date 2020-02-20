<?php
require 'common.php';

$updatequery="UPDATE users SET ctr='0'";
$runupdatequery= mysqli_query($con, $updatequery);



?>
