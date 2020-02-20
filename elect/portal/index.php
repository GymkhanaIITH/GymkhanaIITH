<?php
$url  = explode("/", $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
array_pop($url);
$url = "http://".implode("/", $url);
require_once 'connect.php';

$votesYet = mysqli_query($db_server, "select * from tokens where ink=1;")
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="google-signin-client_id" content="649901427086-7cc9d0o9008gkm4bhdkj2oav70gd36ge.apps.googleusercontent.com"
>

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>


	<script>
	  function signOut() {
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
		  console.log('User signed out.');
		});
	  }
		<?php
		if ($_GET['error'] == 2 || $_GET['success'] == 1)
		echo "signOut();";
		
		?>

	function onSignIn(googleUser) {
		var profile = googleUser.getBasicProfile();

		if(profile.getEmail().indexOf("iith.ac.in") < 0)
		{
		signOut();
		window.location="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=<?php echo $url; ?>/index.php?error=1";
		}
		else
		{
		var id_token = googleUser.getAuthResponse(true).access_token;
		window.location="validate.php?token_id="+id_token;
		}
	}

	</script>
<style>
.vertical-align {
    display: flex;
    align-items: center;
}
</style>


    <!-- Document Title
    ============================================= -->
    <title>Student Login | IIT Hyderabad Gymkhana Elections 2017</title>

</head>

<body>

	<div class="container-fluid" style="position: absolute; top: 20%; width: 100%;">   


		<div class="row vertical-align">
			<img class="img-responsive center-block" src="images/gymlogo.png" width="200" alt="">
		</div>

		<div class="row">

			<div class="panel panel-default divcenter noradius noborder center-block" style="max-width: 400px; "> 
				<div class="panel-body" style="padding-top: 35px" align="center">
					Please authenticate yourself using your IITH ID to vote.
					<div class="g-signin2" data-onsuccess="onSignIn" style="padding-top:20px"></div>
					<?php

					echo "<script>console.log( 'Debug Objects: " . mysqli_num_rows($votesYet) . ";' );</script>";

					if($_GET['error'] == 1)
					echo "<div style='padding-top:10px; color:red'>Please sign in using your @iith.ac.in email id only."; 
					else if($_GET['error'] == 2)
						echo "<div style='padding-top:10px; color:red'>You can only vote once.";
					else if($_GET['error'] == 3)
						echo "<div style='padding-top:10px; color:red'>Sorry, you are using an invalid email ID.";

					echo "<div style='padding-top:30px;'>Total number of votes polled: ".(string) mysqli_num_rows($votesYet)
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="row center dark"><small></small></div>


</div>



</body>
</html>
