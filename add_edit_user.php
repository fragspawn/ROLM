<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/roll_style.css">
</head>
<body>
<?php
/*
Based on the web form from Week #1 make a insert_record.php file that:

*1. Checks the form input that there is no code injection 
*2. Write code that first checks to see if e-mail/username isn't already in the database
*3. Write code that will insert the form submission data as a new record in the database
*4. Find out what the insert ID was (primary key)
*5. Echo to the screen the success/fail
*/

// STEP #1 Declare connection information about the MySQL database
$uri = "mysql:dbname=rolls;host=127.0.0.1";
$user = "root";
$pass = "abc123";

// STEP #2 Attempt a connection and set debug mode on
$conn = new PDO($uri, $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
Implement UPDATE function on users.php, to popup a pre-populated form, and submit to update.php and alter a pre-existing record in the database.
*/
if(isset($_POST['submit'])) {
	if($_POST['submit'] == 'update') {
		$sql = "UPDATE user SET username = '" . $_POST['username'] . "', password = '" . $_POST['password'] . "', firstname = '" . $_POST['firstname'] . "', lastname = '" . $_POST['lastname'] . "', email = '" . $_POST['email'] . "', phone_number = '" . $_POST['phone'] . "', usertype = '" . $_POST['usertype'] . "' WHERE userID = " . $_POST['userid'];

// debug and die
		echo $sql;
		die();

		try {
			$result = $conn->query($sql); 
		} catch(PDOException $ex) {
			echo $ex . '<br/>' . $sql;
			die();
		}
		// STEP 4 Do something with that query

		echo 'All Done Record updated (ha ha)';

	} elseif($_POST['submit'] == 'add') {
		$check_sql = "SELECT * FROM user WHERE username = :username OR email = :email";
		$check_statement = $conn->prepare($check_sql);
        $check_statement->bindValue(':username', $_POST['username']);
        $check_statement->bindValue(':email', $_POST['email']);
        $check_statement->execute();
		$check_result = $check_statement->fetchAll();

		if(empty($check_result)) {
			$sql = "INSERT INTO user (username, password, firstname, lastname, email, phone_number, usertype) VALUES (:username, :password, :firstname, :lastname, :email, :phone_number, 'S');";
			$statement = $conn->prepare($sql);
			$statement->bindValue(':username', $_POST['username']);
			$statement->bindValue(':password', $_POST['password']);
			$statement->bindValue(':firstname', $_POST['firstname']);
			$statement->bindValue(':lastname', $_POST['lastname']);
			$statement->bindValue(':email', $_POST['email']);
			$statement->bindValue(':phone_number', $_POST['phone']);

			// STEP 3 Execute the Query 
			try {
				$result = $statement->execute();
			} catch(PDOException $ex) {
				echo $ex . '<br/>' . $sql;
				die();
			}
			// STEP 4 Do something with that query
			if($result) {
				echo $conn->lastInsertId(); 
			}	
		} else {
			echo "bad news buddy: user/pass exists";		
			die();
		}
		echo 'All Done Record inserted';
		die();
	}
	echo 'nothing done';
}
?>
</body>
</html>
