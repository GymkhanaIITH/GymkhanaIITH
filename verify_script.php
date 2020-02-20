
<?php

if(isset($_POST['submit']))
{

require 'common.php';
session_start();
$email=$_POST['email'];

$queryv = "SELECT verified FROM users WHERE email='$email' ";
$runq = mysqli_query($con,$queryv);

$rowsc=mysqli_fetch_array($runq);
$ver=$rowsc['verified'];

if($ver==0){
$_SESSION['email']=$email;
$key = time();
$vkeyin="UPDATE users SET vkey='$key' WHERE email='$email'";
$runqu = mysqli_query($con,$vkeyin);
$extractk="SELECT vkey FROM users WHERE email='$email'";
$runextract=mysqli_query($con,$extractk);
$fetching=mysqli_fetch_array($runextract);
$vkey=$fetching['vkey'];


echo "do not refresh this page<br><br>";


$to= $email;
$subject='verification mail:somebody is trying to access your gymkhana printing account';
$message='Is that you ..?enter this key to get your account verified.'.$vkey;
$headers='From :gymkhanaprinter@gmail.com';
if(mail($to , $subject , $message, $headers))
{
echo "sent<br><br>check your inbox<br><br> ";
echo"<form method='post' action='code.php'>";
echo" <input type='text' placeholder='activation code' name='code'>";
echo"<input type='submit' value='done' name='done' >";
echo "</form>";





}
else
{
echo "email failed";
}
}


else{
echo"already a verified account";

}

}







?>

