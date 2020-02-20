<?php
require 'common.php';
?>
<html>
    <head><title>IITH print</title>
            <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap-3.3.7-dist/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </head>
    <body><br><br><br><br><br>
         <div class="container">  
          <div class="col-xs-6 col-xs-offset-3"><div class="panel panel-danger" >
          
                  <form method="post" action="login_script.php">
                     <br> <input type="text" class="form-control" placeholder="email" name="email"><br>
                     <br> <input type="password" class="form-control" placeholder="password" name="password"><br>
                     <center> <input type="submit" value="login" name="submit"> </center><br>
                     <p> Don't have an account? <a href="user_registration.php" >SignUp</a> to create an account</p>
                  
                    </form>
                  
              </div></div></div>
 <center><div id='clock'></div>
     <div id="date"></div>
           <script type='text/javascript'>
               setInterval(displayclock,500);
                   function displayclock(){
                   var time =new Date();
                   var hrs = time.getHours();
                   var min = time.getMinutes();
                   var sec = time.getSeconds();
                   if(hrs<10){
                       hrs='0'+hrs;
                   }
                    if(min<10){
                       min='0'+min;
                   }
                    if(sec<10){
                     sec='0'+sec;
                   }
                   
                   document.getElementById('clock').innerHTML=hrs +':'+min+ ':'+sec ;
                   
                       
                       var dates = new Date();
                       var day = dates.getDate();
                       
                       document.getElementById('date').innerHTML= day;
                       if(day<10){
                           day='0'+day;
                       }
         
                   
                    
                   
if( day ==01 && hrs>00 && hrs <12)
{
window.location.href="update.php";
                    
                       
}
                     
                    

                  
                  
                
                    
                       
              
                   
        
             
    }</script></center>

 
     
    
                
    </body>
</html>



