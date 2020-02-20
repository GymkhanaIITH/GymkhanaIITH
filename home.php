<?php
session_start();
error_reporting(0);
require 'common.php';
echo"<br><br><br><br>";
echo "<center><h3> WELCOME </h3></center>";
$sessionvar=$_SESSION['email'];
echo"<h4 align=center> $sessionvar</h4>";



if($sessionvar==TRUE)
{
   
}else{
    header('location:login.php');
    
}
?>



<html>
    <head>
        
        <title>homepage</title>
                <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap-3.3.7/js/jquery-3.4.1.min.js"></script>
         <script type="text/javascript" src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
         <style>.mitochondria{
                 background-color: #080808;
                 color:#f0f0f0;
             }</style>
    </head>
    <body><br><br><br>
            <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container ">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">IITH PRINTING</a>
                </div>
               <div>
                <ul class="nav navbar-nav navbar-right">
                 
                    <li class="active"><a href="logout.php" target="_self"><span class="glyphicon glyphicon-log-out"> Logout </span></a></li>
                </ul>
                   </div>
            </div>
        </nav><br><br><br>
        <?php
         $ctrquery="SELECT ctr FROM users WHERE  email='$sessionvar' ";
    $sqlqueryrun= mysqli_query($con, $ctrquery);
    $rows_fetched= mysqli_fetch_array($sqlqueryrun);
    $ctr= $rows_fetched['ctr'];
    
    if($ctr<15){
      $pl=(15-$ctr);
      echo"<center><h2> Prints Left :".$pl."</h2></center> :";
        
    }else{
        header('location:limit.php');
        
    }
   
    
    
    ?><br><br><br>
        
        
       <center> <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" value=""/><br><br>
            <button type="submit" name="submit">UPLOAD</button>
            
           </form><br><br>
             <h2 style="font-family:'Roboto';">Instructions</h2><br>
             <h4 style="font-family:'Raleway'"> Make sure that the epson 3150 printer is online and has pages. </h4>
             <h4 style="font-family:'Raleway'">Only <b>pdf</b>,<b>jpg</b>,<b>jpeg</b> and <b>png</b> files are allowed to upload,keep the<br> name simple and it shouldn't contain a '<b>.</b>' in it's name.</h4>
            
            
 </center>
         
          
    
    <br><br><br><br><br><br>
          <div class="container-fluid mitochondria">
              <center> <h3>MADE AND MAINTAINED UNDER STUDENT GYMKHANA , IIT HYDERABAD </h3>
                  </center><h6>Credits:Divyansh Maduriya <center>For any queries or suggestions mail us at "<b>gymkhanaprinter@gmail.com</b>"</center></h6>
                    
                    
                </div>
    </body>
</html>

