<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/roll_style.css">
</head>
<body>

<?php

/* Write a calculator */
$num1 = 0;
$num2 = 0;
// Check to see if the submit button is pressed then
if(isset($_POST['submit'])) {
	$num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
	// Check to see what the operator value is & do the calculation
	switch ($_POST['operator']) {
		case '1':
			$operator = '+';
			$result = $num1 + $num2;
			break;
		case '2':
			$operator = '-';
			$result = $num1 - $num2;
			break;
		case '3':
			$operator = '*';
			$result = $num1 * $num2;
			break;
		case '4':
			$operator = '/';
			$result = $num1 / $num2;
			break;
		default:
			$operator = '!';
			echo 'error ';
			$result = -1;
	}
	// output the result
	echo 'result = ' . $_POST['num1'] . ' ' . $operator . ' ' .  $_POST['num2'] . ' is ' . $result;
}
?>
<form action="calc.php" method="post">
	<input type="text" name="num1" size="3" placeholder="num1" value="<?php echo $num1; ?>">
	<select name="operator">
		<option value="1">+</option>
		<option value="2">-</option>
		<option value="3">*</option>
		<option value="4">/</option>
		<option value="5">?</option>
	</select>
	<input type="text" name="num2" size="3" placeholder="num2" value="<?php echo $num2; ?>">
	<input type="submit" name="submit" value="calculate">
</form>
</body>
