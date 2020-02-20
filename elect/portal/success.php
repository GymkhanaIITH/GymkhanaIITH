<?php
session_start() ;
session_destroy() ;
$url  = explode("/", $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
array_pop($url);
$url = "http://".implode("/", $url);
?>
<html>
 <meta name="google-signin-client_id" content="649901427086-7cc9d0o9008gkm4bhdkj2oav70gd36ge.apps.googleusercontent.com">
<head>
</head>
<title>
GYMKHANA ELECTIONS
</title>
<style type="text/css">
body{
	background-color: black;
	font-family: Calibri;
	color:white;
}
.title{
	color: rgb(150,150,150);
	font-size: 42px;
}
form{
	border:1px solid white;
	display: inline-block;
	padding:20px;
}
</style>
	 
<body>
<center>
<h1 class="title">Gymkhana Elections 2017</h1>
<br>
<br>
Your vote has been registered. You will be redirected to main page in 5 seconds.
</center>
<script>
setTimeout(function(){
document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo $url; ?>/";
},5000);
</script>
</body>
</html>
