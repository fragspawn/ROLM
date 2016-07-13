<html>
<head>
</head>
<link rel="stylesheet" type="text/css" href="./css/roll_style.css">
<body>
<?php
/*
	User management form 
	Contains fields from 'user' table in database

	Form validation restrictions
*/

?>
<div class="input_form">
    <form id="add_edit_form">

        <input type="text" name="firstname" id="firstname" class="input_field">
        <input type="text" name="lastname" id="lastname" class="input_field">

        <input type="email" name="email" id="email" class="input_field">
        <input type="number" name="phone" id="phone" class="input_field">

        <input type="text" name="username" id="username" class="input_field">
        <input type="password" name="password" id="password" class="input_field">

<!-- If user needs INSERT or UPDATE -->
        <input type="submit" name="submit_user_add" value="add">
        <input type="submit" name="submit_user_edit" value="update">
    </form>
</div>
</body>
</html>
