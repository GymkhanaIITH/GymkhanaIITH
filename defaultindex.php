
<?php
if(isset($_POST['submit'])){
$cmd="cd /var/www/html/uploads ; lp doubt3.jpg";
$abc=shell_exec($cmd);
}
?>
<head><title>
</title>
</head>
<body>
<form method ="post" action=""><input type="submit" value="print" name="submit"></input></form>
</body>

