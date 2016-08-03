<?php

if(isset($_POST['del_button'])) {
    // STEP #1 Declare connection information about the MySQL database
    $uri = "mysql:dbname=rolls;host=127.0.0.1";
    $user = "root"; $pass = "abc123";

    // STEP #2 Attempt a connection and set debug mode on
    $conn = new PDO($uri, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $check_sql = "DELETE FROM user WHERE userID=:postdata;";
    $check_statement = $conn->prepare($check_sql);
    $check_statement->bindValue(':postdata', $_POST['hidden_user_id']);

    // STEP 3 EXECUTE THE QUERY
    try {
        $check_statement->execute();
        //$check_result = $check_statement->fetchAll();
    } catch(PDOException $ex) {
        echo $ex . '<br/>' . $sql;
        die();
    }
    // NO STEP 4 NO RESULTS
	echo 'redirect when finished button del'; 
} 

if(isset($_POST['delete_checked'])) {
    // STEP #1 Declare connection information about the MySQL database
    $uri = "mysql:dbname=rolls;host=127.0.0.1";
    $user = "root"; $pass = "abc123";

    // STEP #2 Attempt a connection and set debug mode on
    $conn = new PDO($uri, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	foreach($_POST['del'] as $del_one) {
    	$del_sql = "DELETE FROM user WHERE userID=:postdata;";
    	$del_statement = $conn->prepare($del_sql);
    	$del_statement->bindValue(':postdata', $del_one);

    	try {
        	$del_statement->execute();
    	} catch(PDOException $ex) {
        	echo $ex . '<br/>' . $sql;
        	die();
    	}
 	} 	

	echo 'redirect when finished cheked del'; 
}
?>
