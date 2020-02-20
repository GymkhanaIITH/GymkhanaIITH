

<?php
session_start();
error_reporting(0);
require 'common.php';
$sessionvar=$_SESSION['email'];
$_SESSION['mail']=$sessionvar;
if($sessionvar==TRUE)
{
}else{
    header('location:login.php');
    
}
function pagecount($parameter1,$parameter2)
{

$comd="cd /var/www/html/uploads ; pdfinfo '$parameter1'";
$output=shell_exec($comd);
$result=preg_split('/\s+/', trim($output));
$index=array_search('Pages:',$result);
$pages=$result[$index+1];
$number=(16-$parameter2);
if($pages<$number)
{
return $pages;
}
else{
header('location:pagecount.php');
return 0;
}
}
?>
<html>
    <head>
        <title>upload</title>
           <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap-3.3.7-dist/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="bootstrap-3.3.7-dist/js/printThis.js"></script>
    </head>
    <body>


        
<?php
        
        if(isset($_POST['submit'])){

$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$filesize = $_FILES["file"]["size"];
$filetype = $_FILES["file"]["type"];
$filerror = $_FILES["file"]["error"];

$fileext=explode('.',$filename);
$fileactualext= strtolower(end($fileext));
$_SESSION['fileext']=$fileactualext;
$allowed= array('jpg','jpeg','png');
$allowed1=array('pdf');
//$_SESSION['pdf']=$allowed1;
//$_SESSION['image']=$allowed;
 
?><div>
            <?php
if(in_array($fileactualext,$allowed))
        {
    if($filerror===0){


$folder="uploads/".$filename;
$_SESSION['path']=$folder;
        
move_uploaded_file($tempname, $folder);
    echo"<nav class='navbar navbar-inverse navbar-fixed-top'>
            <div class='container '>
                <div class='navbar-header'>
                    <a href='' class='navbar-brand'>IITH Printing</a>
                </div>
               <div>
                <ul class='nav navbar-nav navbar-right'>
                 
                    <li class='active'><a href='logout.php' target='_self'><span class='glyphicon glyphicon-log-out'> Logout </span></a></li>
                </ul>
                   </div>
            </div>
        </nav>";
    echo "<div class='container' ><img src='$folder' height='90%' width='100%'/></div>";
   echo"<form method ='post' action='print.php'><input type='submit' value='Print' name='print' class='btn btn-primary' ></form>";
       
// $('#print').click(function(){
   //             $('.container').printThis();
     //           })

    
   
    

//echo"<a href='logout.php' target='_self'>logout</a>";
 

   }
 else {
     echo "error in uploading file";
    
}
}
elseif(in_array($fileactualext, $allowed1))
{
    if($filerror===0){
 $ctrquery2="SELECT ctr FROM users WHERE  email='$sessionvar' ";
    $sqlqueryrun2= mysqli_query($con, $ctrquery2);
    $rows_fetched2= mysqli_fetch_array($sqlqueryrun2);
    $cts2= $rows_fetched2['ctr'];

       
 $count=pagecount($filename,$cts2);
 $_SESSION['count']=$count;



        $folder1="uploads/".$filename;
        $_SESSION['path']=$folder1;
        move_uploaded_file($tempname, $folder1);
          echo"<nav class='navbar navbar-inverse navbar-fixed-top'>
            <div class='container '>
                <div class='navbar-header'>
                    <a href='#'class='navbar-brand'>IITH Printing</a>
                </div>
               <div>
                <ul class='nav navbar-nav navbar-right'>
                 
                   <li class='active'><a href='logout.php' target='_self'><span class='glyphicon glyphicon-log-out'> Logout <///span></a></li>
                </ul>
                   </div>
            </div>
       </nav>";
  
        echo"<div class='container'><embed src='$folder1' type='application/pdf' width='100%' height='900px'>";
        echo"<form method ='post' action='print.php'><input type='submit' value='Print' name='print' class='btn btn-primary' ></form>";
      

    }else{
        echo "error in uploading file";
    }
}
else{
    echo "this file format is not allowed";
}
}

?>
  
</div>
       
        </body>
</html>


