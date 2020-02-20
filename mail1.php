<?php
$to= 'ee18btech11013@iith.ac.in';
$subject='test mail';
$message='chal gya bc';
$headers='From :gymkhanaprinter@gmail.com';

if(mail($to , $subject , $message, $headers,$parameter))
{
echo "sent ";
}else
{
echo "email failed";
}?>
  
            

