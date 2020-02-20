<?php
error_reporting(E_ALL);
session_start();

require_once 'connect.php';
require_once 'validEmails.php';

$_SESSION['token']='';
$_SESSION['logged']=false;

$url  = explode("/", $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
array_pop($url);
$url = "http://".implode("/", $url);

if(!isset($_GET['token_id'])){
	echo '<html><script>window.location.href=".";</script></html>';
	return;
}
$curl = curl_init("https://www.googleapis.com/oauth2/v1/userinfo");

curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
$curlheader[0] = "Authorization: Bearer " . $_GET['token_id'];
curl_setopt($curl, CURLOPT_HTTPHEADER, $curlheader);

$json_response = curl_exec($curl);
curl_close($curl);
$userInfo = json_decode($json_response);

preg_match('/[0-9]([a-zA-Z]+)[0-9]+@/i', $userInfo->email, $matches);
$type = strtolower($matches[1]);
$cat = "";

if($type=="btech" || $type=="b" || $type=="mscst" ||  $type=="msc")
	$cat = "UG";
if($type=="mtech"  ||  $type=="m" || $type=="mphil"|| $type=="mdes")
	$cat = "PG";
if($type=="resch" || $type=="p")
	$cat = "PHD";


if(in_array(strtoupper($userInfo->email), $validEmails) == false) {
	echo "<script>console.log( 'Debug Objects: " . $userInfo->email . ";' );</script>";

	echo "		<html>	<script> window.location.href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=".$url."/?error=3';</script></html>";
} else if(strpos($userInfo->email, "@iith.ac.in") > 0 && $cat != "") {

	$token = md5($userInfo->email);

	$result=mysqli_query($db_server,"select * from tokens where token='$token';");
	if(mysqli_num_rows($result)==0){
		mysqli_query($db_server, "INSERT INTO tokens (token, ink) VALUES ('$token', 0)") or die("Error inserting");	
	} else {
		$row=mysqli_fetch_row($result);
		if($row[2]==1){ // Already voted

			?>
			<html>	<script> window.location.href="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo $url; ?>/?error=2";</script></html>
			<?php
			return;
		}
	}
	
	$_SESSION['logged']=true;
	$_SESSION['token']=$token;
	$_SESSION['cat']=$cat;
	echo '<html><script>window.location.href="vote.php";</script></html>';
	
} else {
	echo "		<html>	<script> window.location.href='https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=".$url."/?error=1';</script></html>";
}
?>
