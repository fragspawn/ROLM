<?php
session_start();

if(isset($_SESSION['loggedon'])) {
    if($_SESSION['loggedon'] == false) {
        //redirect to success       
        header('Location: ./login.php');
    }
} else {
    header('Location: ./login.php');
}

if(isset($_GET['logout'])) {
	session_destroy();
    header('Location: ./login.php');
}
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/roll_style.css">
</head>
<body>
<a href="success.php?logout=true">logout</a>
</body>
