<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/roll_style.css">
</head>
<body>

<?php
session_start();
//Write a processing page that will accept only 1 username "bobbyblaster"/"paSSw0rd"

if(isset($_POST['submit_login'])) {
	// output the result
	if(($_POST['username'] == 'bobbyblaster') && ($_POST['password'] == 'paSSw0rd')) {
//		$_SESSION['loggedin'] = true;
		echo " happy "; 
	} else {
//		$_SESSION['loggedin'] = false;
		echo " sad "; 
	}
}
?>
</body>
