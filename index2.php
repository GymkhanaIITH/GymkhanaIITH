<?php

$name='DE1.pdf';
$comd="cd /var/www/html/uploads ; pdfinfo '$name'";
$output=shell_exec($comd);
$result=preg_split('/\s+/', trim($output));
$index=array_search('Pages:',$result);
echo $result[$index+1];



?>
