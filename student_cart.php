<?php 
session_start();

// Connect to the database
$db_user = 'root'; $db_pass = 'abc123'; $db_uri = "mysql:dbname=rolls;host=127.0.0.1";
$conn = new PDO($db_uri, $db_user, $db_pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function change_qty($item, $qty) {
	$found = false;
	$loop = 0;
	foreach($_SESSION['cart'] as $item_list) {
		if($item_list[0] == $item) {
			$_SESSION['cart'][$loop][1] = $qty;
			$found = true;
			break;
		}
		$loop++;
	}
}

function add_to_cart($item, $qty) {
	// check to see if the item is already here if true increment qty
	if(isset($_SESSION['cart'])) {
		// check for the existence of the item:
		$found = false;
		$loop = 0;
		foreach($_SESSION['cart'] as $item_list) {
			if($item_list[0] == $item) {
				$_SESSION['cart'][$loop][1] = $_SESSION['cart'][$loop][1] + $qty;
				$found = true;
				break;
			} 
			$loop++;
		}
		if($found == false) {
			$_SESSION['cart'][] = array($item, $qty);
		}
	} else {
		$_SESSION['cart'][0] = array($item, $qty);
	}
}

function del_from_cart($item) {
	$loop = 0;
	$found = false;
	foreach($_SESSION['cart'] as $item_list) {
   	// Search in array for item, then set it's qty to 0;
		if($item_list[0] == $item) {
			$_SESSION['cart'][$loop][1] = 0;
			$found = true;
			break;
		} 
		$loop++;
	}
}

function empty_cart() {
  	unset($_SESSION['cart']);
}

function show_cart() {
   	// iterate through each item and print it to the screen (SELECT on product table may be necessary)
	foreach($_SESSION['cart'] as $item) {
		if($item[1] > 0) {
			echo '<form method="post" action="student_cart.php">';

			echo get_product_detail($item[0]);

			echo '<select name="cart_qty" onChange="this.form.submit();">';
			for($i = 0;$i<100;$i++) {
				if($i == $item[1]) {
					echo '<option value="' . $i . '" selected>' . $i . '</option>';
				} else {
					echo '<option value="' . $i . '">' . $i . '</option>';
				}
			}
			echo '</select>';
			echo '<input type="hidden" name="item_id" value="' . $item[0] . '">';
			echo '</form>';

			echo '<form method="post" action="student_cart.php">';
			echo '<input type="hidden" name="item_id" value="' . $item[0] . '">';
			echo '<input type="submit" name="delete_from_cart" value="delete">';
			echo '</form>';
		}
	}
 	echo '<p><a href="student_cart.php?empty=true">Empty Cart</a></p>';
}

function show_products() {
	global $conn;
	// SELECT all items available to add to cart and have an 'add to cart' button
	$sql = "SELECT * FROM classroom";

	$check_conn = $conn->prepare($sql);
   	$check_conn->execute();
  	$result = $check_conn->fetchAll();

	foreach($result as $row) {
		echo '<form method="post" action="student_cart.php">';
		echo $row['Class_name'] . ' ' . $row['Class_room_no'] . ' ' . $row['Class_day'];
		echo '<select name="add_to_cart_qty">';
		echo '<option value="1">1</option>';
		echo '<option value="2">2</option>';
		echo '<option value="3">3</option>';
		echo '<option value="4">4</option>';
		echo '<option value="5">5</option>';
		echo '<option value="6">6</option>';
		echo '<option value="7">7</option>';
		echo '<option value="8">8</option>';
		echo '<option value="9">9</option>';
		echo '</select>';
		echo '<input type="hidden" name="item_id" value="' . $row['ID'] . '">';
		echo '<input type="submit" name="add_to_cart" value="add to cart">';
		echo '</form>';
	}
}

function get_product_detail($prod_id) {
	global $conn;
	$sql = "SELECT Class_name from classroom WHERE ID = " . $prod_id;

	$prod_conn = $conn->prepare($sql);
   	$prod_conn->execute();
  	$result = $prod_conn->fetch();

	return $result['Class_name'];
}

if(isset($_POST['delete_from_cart'])) {
	del_from_cart($_POST['item_id']);
}

if(isset($_POST['add_to_cart'])) {
	add_to_cart($_POST['item_id'], $_POST['add_to_cart_qty']);
}

if(isset($_POST['cart_qty'])) {
	change_qty($_POST['item_id'], $_POST['cart_qty']);
}

if(isset($_GET['empty'])) {
	empty_cart();
}

?>

<html>
<script>
	function submitDropdown(dropdown_element) {
		dropdown_element.parentElement.submit();
	}
</script>
<body>
<?php 
	show_products(); 
	echo '<hr>';
	if(isset($_SESSION['cart'])) {
		show_cart();
		echo '<hr>';
		echo count($_SESSION['cart']);
		echo '<br>';
		echo print_r($_SESSION['cart']);
	}
?>
</body>
</html>
