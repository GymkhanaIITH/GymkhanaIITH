<?php
if(isset($_POST['print']))
{

session_start();
require 'common.php';
$Email=$_SESSION['mail'];
    $ctrquery="SELECT ctr FROM users WHERE  email='$Email' ";
    $sqlqueryrun= mysqli_query($con, $ctrquery);
    $rows_fetched= mysqli_fetch_array($sqlqueryrun);
    $ctr= $rows_fetched['ctr'];
if($ctr<15)
{

}

else{

header('location:limit.php');

}



$path=$_SESSION['path'];

$to = 'gymkhanaPrint@print.epsonconnect.com';
//$to = 'ee18btech11013@iith.ac.in';
$from = 'gymkhanaprinter@gmail.com';
$fromName = 'gymkhana Printer';
$subject = 'attachment'; 
$file=$path;

$htmlContent = '';

$headers = "From: $fromName"." <".$from.">";

$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 


$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 


if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($file)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}

$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;


if(mail($to, $subject, $message, $headers, $returnpath)){
echo"<h1>Task Complete</h1><br><h1>WAIT FOR 10-20 SEC";
echo"<br><h3>Sometimes it may take a bit longer So be Patient.</h3>";
$fileext=$_SESSION['fileext'];
$allowed= array('jpg','jpeg','png');
$allowed1=array('pdf');

if(in_array($fileext,$allowed))
{
$ctrquery2="SELECT ctr FROM users WHERE  email='$Email' ";
    $sqlqueryrun2= mysqli_query($con, $ctrquery2);
    $rows_fetched2= mysqli_fetch_array($sqlqueryrun2);
    $ctn= $rows_fetched2['ctr'];
       $ctn++;



 $ctr_update_query="UPDATE users SET ctr='$ctn' WHERE email='$Email'";
   $query_result=mysqli_query($con,$ctr_update_query);
    

}
elseif(in_array($fileext,$allowed1))
{

 
$count=$_SESSION['count'];



$ctrquery1="SELECT ctr FROM users WHERE  email='$Email' ";
    $sqlqueryrun1= mysqli_query($con, $ctrquery1);
    $rows_fetched1= mysqli_fetch_array($sqlqueryrun1);
   $cts= $rows_fetched1['ctr'];
        $cts=$cts+$count;



 $ctr_update_query="UPDATE users SET ctr='$cts' WHERE email='$Email'";
   $query_result=mysqli_query($con,$ctr_update_query);
        
}


}

else{
echo"failed";
}
//echo $mail?"<h1>task complete...wait for 10-20 seconds</h1>":"<h1>Mail sending failed.</h1>";
}
              
  
?>
