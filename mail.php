<?php
$to= 'ee18btech11013@iith.ac.in';
$subject='test mail';
$message='hi';
$headers='From :divyanshmaduriya02@gmail.com';
if(mail($to , $subject , $message, $headers))
{
echo "sent ";
}else
{
echo "email failed";
}?>

