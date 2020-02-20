<?php
session_start();
$printfile=$_SESSION['filename'];
echo $printfile;
//$cmd="cd /var/www/html/uploads ; lp '$printfile'";
//$abc=shell_exec($cmd);

?>
