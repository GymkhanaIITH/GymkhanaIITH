<?php
require 'common.php';

$name= mysqli_real_escape_string($con,$_POST['name']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$confirm_password=mysqli_real_escape_string($con,$_POST['confirmpassword']);
$ctr=0;
if($password===$confirm_password){
$uniqueverify="SELECT * FROM users WHERE email='$email'";
$check= mysqli_query($con,$uniqueverify);
$rowcount=mysqli_num_rows($check);
if($rowcount==0){
$user_registration_query="INSERT INTO users(name,email,password,ctr,verified)values('$name','$email','$password','$ctr','0')";
$user_registration_submit= mysqli_query($con, $user_registration_query)or die(mysqli-error($con));
echo "user sucessfully registered";
echo " <a href ='verify.php' target='_self'>click here </a> for the verification of your account";
}
else{
  echo"account already exists";
}
}else{
    echo "your passwords do not match";
}
?>
