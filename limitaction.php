<?php
session_start();
error_reporting(0);
require 'common.php';
$sessionvar=$_SESSION['email'];
    if(isset($_POST['submit'])){
        
         $ctrquery2="SELECT ctr FROM users WHERE  email='$sessionvar' ";
    $sqlqueryrun2= mysqli_query($con, $ctrquery2);
    $rows_fetched2= mysqli_fetch_array($sqlqueryrun2);
    $ctn= $rows_fetched2['ctr'];
        $ctn++;
    
    
    $ctr_update_query="UPDATE users SET ctr='$ctn' WHERE email='$sessionvar'";
    $query_result=mysqli_query($con,$ctr_update_query);
    echo "<a href='index.php' target='_self'>index page</a>";
    }

