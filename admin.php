<?php
include 'vue/header.php';

?>

<ul>
<li><a href="#" onClick="get_data('teacher')">Teachers</a></li>
<li><a href="#" onClick="get_data('student')">Students</a></li>
<li><a href="#" onClick="get_data('classes')">Classes</a></li>
</ul>

<div id="content_frame">
	<form>
		<div id="listing_data"></div>
		<input type="checkbox" onClick="checkAll()" name="delete_all" value="">
	</form>
</div>
		<script>
			function get_data(method) {
				var outdiv = '<a href="#" onClick="doPopup(' + method + ',0)">Add New...</a>';
				if(method == 'teacher') {
					var url = "ws/admin_ws.php?datatype=teachers";
				}	
				if(method == 'student') {
					var url = "ws/admin_ws.php?datatype=students";
				}	
				if(method == 'classes') {
					var url = "ws/admin_ws.php?datatype=classes";
				}

				$.getJSON(url, function( json_data ) {
					for (var key in json_data) {	
						var counter = 0;
						outdiv += '<section>';
						for(var subkey in json_data[key]) {
							switch(counter) {
								case 0:	
									var index_val = json_data[key][subkey];
									break;
								case 1:	
									outdiv += '<span><a href="#" onClick="doPopup(' + method + ',' + index_val + ')">' + json_data[key][subkey] + '</a></span>';
									break;
								case 2:
									outdiv += '<span>' + json_data[key][subkey] + '</span>';
									break;
								case 3:
									outdiv += '<span>' + json_data[key][subkey] + '</span>';
									break;
								case 4:
									outdiv += '<span>' + json_data[key][subkey] + '</span>';
									break;
								case 5:
									outdiv += '<span>' + json_data[key][subkey] + '</span>';
									break;
							}
							counter++;
						}
						outdiv += '<input type="checkbox" name="delete_ids[]" value="' + index_val + '">';
						outdiv += '</section>';
					}
					listing_data.innerHTML = outdiv;
 				});
			}
		</script>

<div class="input_form">
    <form id="add_form" method="post" action="#" onSubmit="return formValidate(this)" novalidate>
        <input type="text" name="firstname" id="firstname" class="input_field" pattern="[A-Z]" placeholder="First Name">
        <input type="text" name="lastname" id="lastname" class="input_field" pattern="[A-Z]" placeholder="Last Name">
        <input type="text" name="email" id="email" class="input_field" pattern="[A-Z]" placeholder="Email">
        <input type="text" name="phone" id="phone" class="input_field" pattern="[A-Z]" placeholder="Phone">
        <input type="text" name="username" id="username" class="input_field" pattern="[A-Z]" placeholder="User Name"> 
        <input type="text" name="password" id="password" class="input_field" pattern="[A-Z]" placeholder="Password">
        <input type="submit" name="submit" value="add">
        <input type="button" name="cancel" value="cancel" onClick="doNotPopup()">
    </form>
</div>

<?php
include 'vue/footer.php';
?>
