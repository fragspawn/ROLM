<?php
/*
	User add/edit form 
	Contains fields from 'user' table in database

	Form validation restrictions YET TO BE IMPLEMENTED
*/

if(isset($_GET['userid'])) {
	// Declare connection information about the MySQL database
	$uri = "mysql:dbname=rolls;host=127.0.0.1";
	$sql = "SELECT * FROM user WHERE userID = :userid";
	$user = "root";
	$pass = "abc123";

	// Attempt a connection and set debug mode on
	$conn = new PDO($uri, $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$statement = $conn->prepare($sql);
	$statement->bindValue(':userid', (int) trim($_GET['userid']), PDO::PARAM_INT);

	// Execute the Query 
	try {
	    $statement->execute();
//		$result = $statement->fetch(PDO::FETCH_ASSOC);
		$result = $statement->fetchall();
	} catch(PDOException $ex) {
    	echo $ex . '<br/>' . $sql;
    	die();
	}
	foreach($result as $row) {
		$username =  $row['username'];
		$password =	$row['password']; 
		$phone = $row['phone_number']; 
		$email = $row['email'];
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$user_id = $row['userID'];
	}
} else {
	$username = '';
	$password = '';
	$phone = '';
	$email = '';
	$firstname = '';
	$lastname = '';
}

?>
<div class="input_form">
    <form id="add_edit_form" method="post" action="add_edit_user.php">
        <input type="text" name="firstname" id="firstname" class="input_field" placeholder="First Name" value="<?php echo $firstname; ?>">
        <input type="text" name="lastname" id="lastname" class="input_field" placeholder="Last Name" value="<?php echo $lastname; ?>">
        <input type="email" name="email" id="email" class="input_field" placeholder="Email" value="<?php echo $email; ?>">
        <input type="text" name="phone" id="phone" class="input_field" placeholder="Phone" value="<?php echo $phone; ?>">
        <input type="text" name="username" id="username" class="input_field" placeholder="User Name" value="<?php echo $username; ?>">
        <input type="password" name="password" id="password" class="input_field" placeholder="Password" value="<?php echo $password; ?>">
<!-- If user needs INSERT or UPDATE -->
<?php 
	if(isset($_GET['userid'])) {
		echo '<input type="hidden" name="userid" value="' . $user_id . '">';
		echo '<input type="hidden" name="usertype" value="S">';
       	echo '<input type="submit" name="submit" value="update">';
	} else {
		echo '<input type="submit" name="submit" value="add">';
	}
?>
       	<input type="button" name="cancel" value="cancel" onClick="doNotPopup()">
    </form>
</div>
