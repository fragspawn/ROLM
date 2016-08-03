<?php
session_start();
//Write a processing page that will accept only 1 username "bobbyblaster"/"paSSw0rd"

if(isset($_POST['submit_login'])) {
	// output the result
	if(($_POST['username'] == 'bobbyblaster') && ($_POST['password'] == 'paSSw0rd')) {
//		$_SESSION['loggedin'] = true;
		echo " happy "; 
		// REDIRECT to success.php
	} else {
//		$_SESSION['loggedin'] = false;
		$_SESSION['login_error'] = 'you got it wrong';
		echo " sad "; 
		// REDIRECT to login.php
	}
}

if(isset($_POST['submit_login'])) {
	// STEP #1 Declare connection information about the MySQL database
	$uri = "mysql:dbname=rolls;host=127.0.0.1";
	$user = "root"; $pass = "abc123";
	// STEP #2 Attempt a connection and set debug mode on
	$conn = new PDO($uri, $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$check_sql = "SELECT * FROM user WHERE username = :username AND password = :password";
	$check_statement = $conn->prepare($check_sql);
	$check_statement->bindValue(':username', $_POST['username']);
	$check_statement->bindValue(':password', $_POST['password']);
	// STEP 3 EXECUTE THE QUERY
	try {
		$check_statement->execute();
		$check_result = $check_statement->fetchAll();
	} catch(PDOException $ex) {
		echo $ex . '<br/>' . $sql;
		die();
	}
	// STEP 4 CHECK THE RESULTS
	if(empty($check_result)) {
		$_SESSION['loggedin'] = false;
		$_SESSION['login_error'] = 'you got it wrong';
		echo " sad "; 
		// REDIRECT to login.php
	} else {
		$_SESSION['loggedin'] = true;
		echo " happy"; 
		// REDIRECT to success.php
	}
} else {
	// REDIRECT to login.php
} // endif
?>
