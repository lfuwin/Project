<?php 
	$auth = $_COOKIE['authorization'];
	header ("Cache-Control:no-cache");
	if(!$auth == "ok") {
		header ("Location:login1.php");
		exit();
	}
?>
<html>
<head> <title>Logged In</title> </head>
<body>
	<p>Successful log-in.</p>
</form>
</body>
</html>
