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
<script>
    function doPopup(link_attrib) {
        grey_background.style.display = 'block';
        popup_dialogue.style.display = 'block';
        // JQuery Method:
        $("#popup_dialogue").load(link_attrib);
    }
    function doNotPopup() {
        grey_background.style.display = 'none';
        popup_dialogue.style.display = 'none';
    }
	function confirmDelete() {
		return confirm("are you sure");
	}

	function check_uncheck(a_checkbox) {
		var class_of_check = a_checkbox.className;
		class_of_checks = document.getElementsByClassName(class_of_check);

		if(a_checkbox.checked == true) {
			for(i=0; i < class_of_checks.length; i++) {
				class_of_checks[i].checked = a_checkbox.checked;
			}
		} else {		
			for(i=0; i < class_of_checks.length; i++) {
				class_of_checks[i].checked = a_checkbox.checked;
			}
		}
	}
</script>
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
<div class="dynamic_content">
