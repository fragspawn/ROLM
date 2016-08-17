<?PHP
// The Admin WEB SERVICE is designed to support all database interactions via GET & POST 
// from admin.php. This represents all add/edit/delete functions for: user, class & enrolment 
// Code must protect from SQL injection & rate limit from overuse
// OUTPUT are JSON structures for inclusion in calling functions AKA admin.php

//echo $_SERVER['REMOTE_ADDR'];

session_start();

// debugging purposes only  -  COMMENT OUT TO SECURE!
$_SESSION['usertype'] = 'admin';

// Check that they are an admin user before continuing;
if(isset($_SESSION['usertype'])) {
	if($_SESSION['usertype'] != 'admin') {
		throw_error();
	}
} else {
	throw_error();
}

// RATE LIMIT the number of requests to only once every 3 seconds
if(isset($_SESSION['last_request'])) {
	if((time() - $_SESSION['last_request']) < 3) {
		throw_error();
    }
}
$_SESSION['last_request'] = time();

// Initially set result condition to be an error
$output = array("result"=>"false");

// Connect to the database
$db_user = 'root'; $db_pass = 'abc123'; $db_uri = "mysql:dbname=rolls;host=127.0.0.1";
$conn = new PDO($db_uri, $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Handle POST data
//
//
if(isset($_POST['submit'])) {
	$posttype = sanatise_input($_POST['submit']);
	if($posttype == 'student_add') {
		// Add student to database from a form submission

		$sql = "INSERT INTO user 
				(username password, firstname, lastname, email, phone_number, usertype) 
				VALUES (:username, :password, :firstname, :lastname, :email, :phone, 'S')";

		$array_of_post_data['username'] = sanatise_input($_POST['username']);
		$array_of_post_data['password'] = sanatise_input($_POST['password']);
		$array_of_post_data['firstname'] = sanatise_input($_POST['firstname']);
		$array_of_post_data['lastname'] = sanatise_input($_POST['lastname']);
		$array_of_post_data['email'] = sanatise_input($_POST['email']);
		$array_of_post_data['phone'] = sanatise_input($_POST['phone']);

		$result = advanced_query_from_db($sql, $array_of_post_data); 
	}	

	if($posttype == 'student_update') {
		// Update student in database via a form submission
		// TODO validate email & username and see if they are not already there...
		$user_id = sanatise_input($_POST['user_id']);
		if(is_numeric($user_id)) {
			$sql = "UPDATE user SET username = :username, password = :password, 
									firstname = :firstname, lastname = :lastname, 
									email = :email, phone_number = :phone 
					WHERE user.userID = " . $user_id;

			$array_of_post_data['username'] = sanatise_input($_POST['username']);
			$array_of_post_data['password'] = sanatise_input($_POST['password']);
			$array_of_post_data['firstname'] = sanatise_input($_POST['firstname']);
			$array_of_post_data['lastname'] = sanatise_input($_POST['lastname']);
			$array_of_post_data['email'] = sanatise_input($_POST['email']);
			$array_of_post_data['phone'] = sanatise_input($_POST['phone']);

			$result = advanced_query_from_db($sql, $array_of_post_data); 
		}
	}

	if($posttype == 'student_delete') {
		// Delete student(s) from database from a form submission
		$delete_ids = $_POST['delete_ids'];
		foreach($delete_ids as $a_del) {
			if(is_numeric($a_del) && ((int)$a_del < 65535)) {
				$sql = "DELETE FROM user WHERE user.userID = :userid"; 
				$array_of_post_data = array(':userid'=>$a_del); 
				$result[] = advanced_query_from_db($sql, $array_of_post_data); 
			}
		}
	}

	if($posttype == 'teacher_add') {
		// Add teacher to database from a form submission
		$sql = "INSERT INTO user 
				(username, password, firstname, lastname, email, phone_number, usertype) 
				VALUES (:username, :password, :firstname, :lastname, :email, :phone, 'T')";

		$array_of_post_data['username'] = sanatise_input($_POST['username']);
		$array_of_post_data['password'] = sanatise_input($_POST['password']);
		$array_of_post_data['firstname'] = sanatise_input($_POST['firstname']);
		$array_of_post_data['lastname'] = sanatise_input($_POST['lastname']);
		$array_of_post_data['email'] = sanatise_input($_POST['email']);
		$array_of_post_data['phone'] = sanatise_input($_POST['phone']);

		$result = advanced_query_from_db($sql, $array_of_post_data); 
	}

	if($posttype == 'teacher_update') {
		// Update teacher in database via a form submission
		// TODO validate email & username and see if they are not already there...
		$user_id = sanatise_input($_POST['user_id']);
		if(is_numeric($user_id)) {
			$sql = "UPDATE user SET username = :username, password = :password, 
									firstname = :firstname, lastname = :lastname, 
									email = :email, phone_number = :phone 
					WHERE user.userID = " . $user_id;

			$array_of_post_data['username'] = sanatise_input($_POST['username']);
			$array_of_post_data['password'] = sanatise_input($_POST['password']);
			$array_of_post_data['firstname'] = sanatise_input($_POST['firstname']);
			$array_of_post_data['lastname'] = sanatise_input($_POST['lastname']);
			$array_of_post_data['email'] = sanatise_input($_POST['email']);
			$array_of_post_data['phone'] = sanatise_input($_POST['phone']);

			$result = advanced_query_from_db($sql, $array_of_post_data); 
		}
	}

	if($posttype == 'teacher_delete') {
		// Delete teacher(s) from database from a form submission
		$delete_ids = $_POST['delete_ids'];
		foreach($delete_ids as $a_del) {
			if(is_numeric($a_del) && ((int)$a_del < 65535)) {
				$sql = "DELETE FROM user WHERE user.userID = :userid"; 
				$array_of_post_data = array(':userid'=>$a_del); 
				$result[] = advanced_query_from_db($sql, $array_of_post_data); 
			}
		}
	}

	if($posttype == 'class_add') {
		// Add class to database from a form submission
		$sql = "INSERT INTO classroom 
				(Class_name, Class_room_no Class_day, Teacher_ID, start_time, end_time) 
				VALUES (:class_name, :classroom :class_day, :teacher_id, :start_time, :end_time)";
	}

	if($posttype == 'class_update') {
		// Update class in database via a form submission
	}

	if($posttype == 'class_delete') {
		// Delete class(es) from database from a form submission
		
	}

	if($posttype == 'enrolment_add') {
		// Add an enrolment to database from a form submission
		$sql = "INSERT INTO enrolment (student_id, class_id) VALUES (:studentid, :classid)";

		$array_of_post_data['studentid'] = sanatise_input($_POST['studentid']);
		$array_of_post_data['classid'] = sanatise_input($_POST['classid']);

		$result = advanced_query_from_db($sql, $array_of_post_data); 
	}
	if($posttype == 'enrolment_del') {
		// Delete an enrolment from database via a form submission
	}
}

// check for valid GET parameters to select out results
//
//
if(isset($_GET['datatype'])) {
	$datatype = sanatise_input($_GET['datatype']);

	if($datatype == 'students') {
		if(isset($_GET['studentID'])) {
			$student_ID = sanatise_input($_GET['student']);
			if(is_numeric($student_ID)) {
				$sql = "SELECT * FROM user WHERE usertype = 'S' AND userID = " . $student_ID;
				$output = query_from_db($sql);	
			}
		} else {
			$sql = "SELECT userID, username, firstname, lastname, email, phone_number FROM user WHERE usertype = 'S'";
			$output = query_from_db($sql);	
		}
	}

	if($datatype == 'teachers') {
		if(isset($_GET['display'])) {
			if($_GET['display'] == 'BRIEF') {
				$sql = "SELECT userID, firstname, lastname FROM user WHERE usertype = 'T'";
			} else {
				$sql = "SELECT userID, username, firstname, lastname, email, phone_number FROM user WHERE usertype = 'T'";
			}
		} else {
			$sql = "SELECT userID, username, firstname, lastname, email, phone_number FROM user WHERE usertype = 'T'";
		}
		$output = query_from_db($sql);	
	}

	if($datatype == 'classes') {
		$sql = "SELECT ClassID, Class_name, Class_room_no, Class_day, start_time, end_time FROM classroom";
		$output = advanced_query_from_db($sql, false);	
	}

	if($datatype == 'enrolments') {
		if(isset($_GET['studentID'])) {
			$student_ID = sanatise_input($_GET['student']);
			if(is_numeric($student_ID)) {
				// Do we need the NAME of the class that the student is enrolment?
				$sql = "SELECT * from enrolment WHERE student_id = :studentid";
				$options_array['studentid'] = $student_ID;

				$output = advanced_query_from_db($sql,$options_array);	
			}
		}
	}
}

// Output JSON data from the database
header('Content-Type: application/json');
echo json_encode($output);

// END:

function throw_error() {
	header('Content-Type: application/json');
	$result =  array("result"=>"false");
	echo json_encode($result);
	die();
}

function throw_success() {
	header('Content-Type: application/json');
	$result =  array("result"=>"true");
	echo json_encode($result);
	die();
}

function sanatise_input($input_string) {
    $input_string = trim($input_string);
    $input_string = htmlspecialchars($input_string, ENT_IGNORE, 'utf-8');
    $input_string = strip_tags($input_string);
    $input_string = stripslashes($input_string);
    return $input_string;
}

function advanced_query_from_db($checked_sql, $post_array) {
	global $conn;
	try {
		$check_conn = $conn->prepare($checked_sql);
		if($post_array != false) {
			foreach($post_array as $keyval=>$itemval) {
				// This may not work correctly...
				if(is_numeric($itemval)) {
					$check_conn->bindParam((':' . $keyval), $itemval, PDO::PARAM_INT);
				} else {
					$check_conn->bindParam((':' . $keyval), $itemval, PDO::PARAM_STR);
				}
			}
		}

		$check_conn->execute();

		if(substr($checked_sql, 0, 6) == "SELECT") {
			$result = $check_conn->fetchAll(PDO::FETCH_ASSOC);
		}

		if(substr($checked_sql, 0, 6) == "INSERT") {
		 	$result = array("result"=>$check_conn->lastInsertId());
		}
		
		if(substr($checked_sql, 0, 6) == "UPDATE") {
		 	$result = array("result"=>"true");
		}

		// this might be broken
		if(substr($checked_sql, 0, 6) == "DELETE") {
			$del_key = 'del:' . key($post_array);	 
			$del_val = $post_array; 
		 	$result = array($del_key=>$del_val);
		}

   	} catch (PDOException $Exception) {
		$result = array("result"=>"false");
	}

	if(empty($result)) {
		return array("result"=>"empty");
	} else {
		return $result;
	}
}

function query_from_db($checked_sql) {
		global $conn;
		try {
			$check_conn = $conn->prepare($checked_sql);
			$check_conn->execute();
			$result = $check_conn->fetchAll(PDO::FETCH_ASSOC);
    	} catch (PDOException $Exception) {
			$result = array("result"=>"false");
		}
	
		if(empty($result)) {
			return array("result"=>"empty");
		} else {
			return $result;
		}
	}
?>
