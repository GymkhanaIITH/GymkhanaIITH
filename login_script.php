<?php
if(isset($_POST['submit'])){

require 'common.php';
session_start();
$email=$_POST['email'];
$password=$_POST['password'];
$sqlquery="SELECT * FROM users WHERE email='$email' && password='$password'";
$data= mysqli_query($con, $sqlquery);
$total= mysqli_num_rows($data);

if($total==1){
$verifyquery="SELECT verified FROM users WHERE email='$email'";
$verifyrun=mysqli_query($con,$verifyquery);
$row_fetched=mysqli_fetch_array($verifyrun);
$verify=$row_fetched['verified'];

if($verify==1){
      $_SESSION['email']=$email;
    header('location:home.php');
}
else{
echo "your account is not verified";
echo"<a href ='verify.php' target='_self'>click here</a> for the verification of your account"
;}
}
else{
    echo "login failed : wrong password or email";
}}


?>


