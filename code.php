<?php

if(isset($_POST['done']))
{
session_start();
error_reporting(0);
require 'common.php';
$sessionvari=$_SESSION['email'];
$code=$_POST['code']; 
$extractk1="SELECT vkey FROM users WHERE email='$sessionvari'";
$runextract1=mysqli_query($con,$extractk1);
$fetching1=mysqli_fetch_array($runextract1);
$vkey=$fetching1['vkey'];
if($code==$vkey){

$entervarquery="UPDATE users SET verified='1' WHERE email='$sessionvari'";
$runupdate=mysqli_query($con,$entervarquery);
echo " Congratulations your verification process is complete <a href='login.php' target='_self'>click here</a> to login";

}
else{
echo "incorrect key";
echo "<a href='verify.php' target=_self>try again</a>";

}

}
?>
