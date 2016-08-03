<?php
session_start();
if(isset($_SESSION['loggedon'])) {
	if($_SESSION['loggedon'] == true) {
		//redirect to success		
		header('Location: ./success.php');
	}
} else {
	 $_SESSION['loggedon'] = false;
}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/roll_style.css">
</head>
<script>
	function doValidate() {
		error = 0;
		error_div.innerHTML = '';
		if(username.checkValidity()) {
			error_div.style.display = 'none';
			username.style.background = 'lightyellow';
		} else {
			error_div.style.display = 'block';
			error_div.innerHTML += 'Username must be 8 or more characters only<br/>';
			username.style.background = 'red';
			error++;
		}
		if(password.checkValidity()) {
			error_div.style.display = 'none';
			password.style.background = 'lightyellow';
		} else {
			error_div.style.display = 'block';
			error_div.innerHTML += 'Password must be 8 or more characters mixed case with numbers<br/>';
			password.style.background = 'red';
			error++;
		}
		// if any of the form elements are red, return false, otherwise return true;
		if(error == 0) {
			return true;
		} else {
			return false;
		}
	}
</script>
<body>
<h1>We'll need to include a header here</h1>
<?php
/*
    Write a login form that checks user validity against table 'users'

    Each field is mandatory
    Username must: mandatory, must be at least 8 characters, mixed case, alpha only
    Password must: mandatory, must be at least 8 characters, mixed case, with a number

    if ether form is not OK, display in an error DIV (absolutely positioned to top)
	on page load the error div is set to display:none;	
	when an error is detected on submit, display the div with a message in innerHTML
*/
?>
    <div class="input_form">
		
	    <form action="process_login.php" method="post" id="login_form" onSubmit="return doValidate();" novalidate>
			<input type="text" name="username" id="username" class="input_field" pattern="(?=.*[a-zA-Z]).{8,}" required>
			<input type="password" name="password" id="password" class="input_field" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
			<input type="submit" name="submit_login" value="login">
		</form>
	</div>
</body>
<div id="error_div"> </div>
<div>
<?php
    if(isset($_SESSION['login_error'])) {
	    echo $_SESSION['login_error'];
	    unset($_SESSION['login_error']);
    }
?>
</div>
</html>
