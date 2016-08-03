<?php
include 'vue/header.php';

/*
1. Create database table for user access to your new system
2. Display all the contents of above table in a PHP page

EXTRA
3. limit the results to only five rows
4. have a nex/previous button
5. Use GET parameters to acheve this
*/
if(isset($_GET['amount'])) { 
    $amount = $_GET['amount']; 
} else { 
    $amount = 5; 
} 

if(isset($_GET['offset'])) { 
    $offset = $_GET['offset']; 
} else { 
    $offset = 0; 
} 

// Declare connection information about the MySQL database
$uri = "mysql:dbname=rolls;host=127.0.0.1";
$sql_count = "SELECT count(*) FROM user";
$sql = "SELECT * FROM user ORDER BY lastname LIMIT " . $amount . " OFFSET " . $offset;
$user = "root";
$pass = "abc123";

// Attempt a connection and set debug mode on
$conn = new PDO($uri, $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Execute the Query 
try {
    $result = $conn->query($sql); 
    $result_count = $conn->query($sql_count);
} catch(PDOException $ex) {
    echo $ex . '<br/>' . $sql;
    die();
}

$total_rows = $result_count->fetchColumn();

// 

echo '<a href="#" onClick="doPopup(\'man_user.php\');">Add User...</a>';

// Iterate through result set
$brown = 1;
echo '<form method="post" action="del_record.php">';
echo '<table>';
echo '<tr class="row_header"><th>username</th><th>first name</th><th>last name</th><th>type</th><th><input id="delcheck" class="delcheck" type="checkbox" onClick="check_uncheck(this);"></th></tr>';
foreach($result as $row) {
    if($brown%2 > 0) {
        echo '<tr class="row_brown">';
        echo '<td><a href="#" onClick="doPopup(\'man_user.php?userid=' . $row['userID'] . '\')">' . $row['username'] . "</a></td>";
        echo '<td>' . $row['firstname'] . "</td>";
        echo '<td>' . $row['lastname'] . "</td>";
        echo '<td>' . $row['usertype'] . "</td>";
        echo '<td>';
			echo '<input type="checkbox" class="delcheck" name="del[]" value="' . $row['userID'] . '">';
		echo "</td>";
        echo '</tr>';
    } else {
			echo '<tr class="row_notsobrown">';
        echo '<td><a href="#" onClick="doPopup(\'man_user.php?userid=' . $row['userID'] . '\')">' . $row['username'] . "</a></td>";
        echo '<td>' . $row['firstname'] . "</td>";
        echo '<td>' . $row['lastname'] . "</td>";
        echo '<td>' . $row['usertype'] . "</td>";
        echo '<td>';
			echo '<input type="checkbox" class="delcheck" name="del[]" value="' . $row['userID'] . '">';
		echo "</td>";
        echo '</tr>';
    }
    $brown++;
} 
echo '<tr><th><input type="submit" name="delete_checked" value="delete"></th></tr>';
echo '</table>';
echo "</form>";
echo '<a href="users.php?amount=' . $amount . '&offset=0">|<- </a>';
if($offset <= 0) {
    echo '<-';
} else {
    $new_offset = $offset - $amount;
    if($new_offset < 0) {
        $new_offset = 0;
    }
    echo '<a href="users.php?amount=' . $amount . '&offset=' . $new_offset . '"><-</a>';
}
echo ' - ';
if($offset > ($total_rows - $amount)) {
    echo '->';
} else {
    $new_offset = $offset + $amount;
    if($new_offset > $total_rows) {
        $new_offset = $total_rows - $offset;
    } 
    echo '<a href="users.php?amount=' . $amount . '&offset=' . $new_offset . '">-></a>';
}
echo '<a href="users.php?amount=' . $amount . '&offset=' . ($total_rows - $amount) . '"> ->|</a>';
include 'vue/footer.php';
