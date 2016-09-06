<?php
	include 'vue/header.php';
?>

<ul class="submenu">
	<li><a href="#" onClick="get_data('teacher')">Teachers</a></li>
	<li><a href="#" onClick="get_data('student')">Students</a></li>
	<li><a href="#" onClick="get_data('classe')">Classes</a></li>
</ul>

<div id="content_frame">
	<!-- Content will be innerHTMLed with JavaScript -->
	<form>
		<div id="listing_data">
		</div>
	</form>
</div>

<div id="popup_dialogue">
	<div id="teacher">
    	<form class="input_form" method="post" action="#" onSubmit="return formValidate(this)" novalidate>
        	<input type="text" name="firstname" id="firstname" class="input_field" pattern="[A-Za-z]{32,}" placeholder="First Name">
        	<input type="text" name="lastname" id="lastname" class="input_field" pattern="[A-Za-z]{32,}" placeholder="Last Name">
        	<input type="text" name="email" id="email" class="input_field" pattern="[A-Z]" placeholder="Email">
        	<input type="text" name="phone_number" id="phone_number" class="input_field" pattern="[A-Z]" placeholder="Phone">
        	<input type="text" name="username" id="username" class="input_field" pattern="[A-Z]" placeholder="User Name"> 
        	<input type="text" name="password" id="password" class="input_field" pattern="[A-Z]" placeholder="Password">
			<input type="hidden" name="userID" id="userID" value="0">
        	<input type="submit" id="teacher_submit" name="teacher_submit" value="add teacher">
        	<input type="button" name="cancel" value="cancel" onClick="doNotPopup()">
    	</form>
	</div>

	<div id="student">
		student add/edit form	
    	<form class="input_form" method="post" action="#" onSubmit="return formValidate(this)" novalidate>
	       	<input type="text" name="firstname" id="firstname" class="input_field" pattern="[A-Za-z]{32,}" placeholder="First Name">
        	<input type="text" name="lastname" id="lastname" class="input_field" pattern="[A-Za-z]{32,}" placeholder="Last Name">
        	<input type="text" name="email" id="email" class="input_field" pattern="[A-Z]" placeholder="Email">
        	<input type="text" name="phone_number" id="phone_number" class="input_field" pattern="[A-Z]" placeholder="Phone">
        	<input type="text" name="username" id="username" class="input_field" pattern="[A-Z]" placeholder="User Name"> 
        	<input type="text" name="password" id="password" class="input_field" pattern="[A-Z]" placeholder="Password">	
			<input type="hidden" name="userID" id="userID" value="0">
        	<input type="submit" id="student_submit" name="student_submit" value="add student">
        	<input type="button" name="cancel" value="cancel" onClick="doNotPopup()">
    	</form>
	</div>

	<div id="classe">
    	<form class="input_form" method="post" action="#" onSubmit="return formValidate(this)" novalidate>
			<input type="text" name="Class_name" id="Class_name" class="input_field" pattern="[a-zA-Z0-9]{8,}" placeholder="Class Name">
			<input type="text" name="Class_room_no" id="Class_room_no" class="input_field" pattern="[a-zA-Z0-9]{8,}" placeholder="Class Room No">
			<input type="text" name="Class_day" id="Class_name" class="input_field" pattern="[a-zA-Z0-9]{8,}" placeholder="Class Day of Week">
			<input type="text" name="Teacher_id" id="Class_name" class="input_field" pattern="[a-zA-Z0-9]{8,}" placeholder="Class Teacher ID">
			<input type="time" name="start_time" id="Class_name" class="input_field" pattern="[a-zA-Z0-9]{8,}" placeholder="00:00">
			<input type="time" name="end_time" id="Class_name" class="input_field" pattern="[a-zA-Z0-9]{8,}" placeholder="00:00">
			<input type="hidden" name="classes_ID" id="classes_ID" value="0">
        	<input type="button" id="classe_submit" name="classe_submit" value="add class">
        	<input type="button" name="cancel" value="cancel" onClick="doNotPopup()">
    	</form>
	</div>
</div>

<?php
	include 'vue/footer.php';
?>
