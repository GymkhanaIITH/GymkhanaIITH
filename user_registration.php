<html>
    <head>
        <title>IITH print</title>
         <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script type="text/javascript" src="bootstrap-3.3.7-dist/js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </head>
    <body>
         <center><h1>SIGN UP</h1></center><br><br>
      <div class="container">  
          <div class="col-xs-6 col-xs-offset-3"><div class="panel panel-danger" >
        
            <form method="post" action="user_registration_script.php" >
           <input type="text" placeholder="Name" class="form-control" name="name" required ="true"><br>
           <input type="email" placeholder="Email" class="form-control" name="email" required="true" pattern="[a-z0-9._%-]+@iith.ac.in"><br>
               <input type="password" placeholder="Password  should contain more than 6 characters" class="form-control" name="password" required="true" pattern=".{6,}"><br>
                 <input type="password" placeholder="confirmPassword" class="form-control" name="confirmpassword" required="true"><br><br>
                          <input type="submit" value="SignUp" class="btn btn-primary"> <br>

            </form>
            
        </div></div></div>
     
        
    </body>
</html>
