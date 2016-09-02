<?php

if(!isset($_SESSION['user_type'])) {
//	header('location: login.php');
}
?>

<html>
<head>
	<script src="./js/jquery-3.1.0.min.js"></script>
	<script src="./js/library.js"></script>
	<link rel="stylesheet" type="text/css" href="./css/roll_style.css">
</head>
<body>
<div class="header_img">
	<img src="./img/ROLM_logo.png">
</div>

<?php
// Admin header moved to admin page
if(isset($_SESSION['user_type'])) {
	if($_SESSION['user_type'] == 'teacher') {
		echo '<nav>Teacher Nav Here</nav>';
	}

	if($_SESSION['user_type'] == 'admin') {
		echo '<nav>Admin Nav Here</nav>';
	}
} else {
	echo '<nav>You Should Not Be here</nav>';
}
?>
<div id="grey_background">
</div>
<div class="dynamic_content">
