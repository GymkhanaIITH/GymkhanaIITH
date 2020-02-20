<?php
session_start();

if(!isset($_SESSION['logged']) || $_SESSION['logged']==false || !isset($_SESSION['token']) || $_SESSION['token']==''){
	echo '<html><script>window.location.href=".";</script></html>';
	return;
}
$_SESSION['logged']=false;

$token=$_SESSION['token'];

require_once 'connect.php';

$result=mysqli_query($db_server,"select * from tokens where token='$token' and ink=0;");
if(mysqli_num_rows($result)==0){
	echo '<html><script>window.location.href="./?error=2";</script></html>';
	return;
}

$string=$_POST['string'];
$votes=explode("$",$string);
$names = [];
for ($i=0;$i<count($votes);$i++){

	$parts = explode(";", $votes[$i]);

	$pos=explode(",",$parts[0]);
	$position=$pos[0];

	if($position=="")
		continue;

	for ($j=1;$j<count($pos);$j++){

		$person=$pos[$j];
		if($person != "" && in_array($person, $names)) // No one should get more than one vote, so checking if someone intentionally tried to tamper the POST request.
		{
		echo "Malformed request.";
			mysqli_query($db_server,"DELETE from votes WHERE token='$token';");
		exit();
		}
		else
		$names[] = $person;

		if($person != "")
		mysqli_query($db_server,"insert into votes (token, position, person, place) values('$token','$position','$person',".$j.");");
		}

	$pos=explode(",",$parts[1]);
	for ($j=0;$j<count($pos);$j++){
$person=$pos[$j];
		if($person != "" && in_array($person, $names))
		{
		echo "Malformed request.";
			mysqli_query($db_server,"DELETE from votes WHERE token='$token';");
		exit();
		}
		else
		$names[] = $person;
if($person != "")
		mysqli_query($db_server,"insert into votes (token, position, person, place) values('$token','$position','$person',0);");

	}


	$result=mysqli_query($db_server,"SELECT * from votesperpost where Post='$position'");
	var_dump($position);
	if(mysqli_num_rows($result) > 0)
	{
	$row=mysqli_fetch_row($result);
	$count = $row[2];
	$count += 1;
	mysqli_query($db_server,"UPDATE votesperpost SET Count=".$count." WHERE Post='$position';");

	}
	else
	{
	mysqli_query($db_server,"insert into votesperpost (Post, Count) values('$position',1);");
	}


}



mysqli_query($db_server,"update tokens set ink=1 where token='$token';");
$_SESSION['token']='';
?>
<script>
window.location.href="success.php";
</script>
