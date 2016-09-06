
// Not Working
document.addEventListener("keypress", keyPressAction, false);

function keyPressAction(evt) {
	if(evt.keycode == 27) {
		console.log(evt.keycode);
		doNotPopup(); 
	}
}

function get_data(method) {
	if(method == 'teacher') {
		var url = "ws/admin_ws.php?datatype=teachers";
	}	
	if(method == 'student') {
		var url = "ws/admin_ws.php?datatype=students";
	}	
	if(method == 'classe') {
		var url = "ws/admin_ws.php?datatype=classes";
	}

	var outdiv = '';
	$.getJSON(url, function( json_data ) {
		outer_counter = 0;
		if(json_data['result'] == 'false') {
			outdiv += '<section>NO DATA</section>';
		} else {
			outdiv += '<span><a href="#" onClick="doPopup(\'' + method + '\',0)">Add New...</a></span>';
			outdiv += '<span></span><span></span><span></span><span></span>';
			outdiv += '<span><input class="delcheck" type="checkbox" onClick="check_uncheck(this)" name="toggle_check"></span>';
			for (var key in json_data) {	
				var counter = 0;
				if((outer_counter % 2) > 0) { 
		 			outdiv += '<section class="row_brown">';

				} else {
		 			outdiv += '<section class="row_notsobrown">';
				}
				outer_counter++;
				for(var subkey in json_data[key]) {
					switch(counter) {
						case 0:	
							var index_val = json_data[key][subkey];
							break;
						case 1:	
							outdiv += '<span><a href="#" onClick="doPopup(\'' + method + '\',' + index_val + ')">' + json_data[key][subkey] + '</a></span>';
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
				outdiv += '<input type="checkbox" class="delcheck" name="delete_ids[]" value="' + index_val + '">';
				outdiv += '</section>';
			}
		}

		outdiv += '<section>';
		outdiv += '<span>delete:</span>';
		outdiv += '<span></span><span></span><span></span><span></span>';
		outdiv += '<span><input type="button" name="delete_checked_submit" value="delete checked"></span>';
		outdiv += '</section>';
		listing_data.innerHTML = outdiv;
	});
}
			
function doPopup(datatype, primary_key) {
	// Open Dialogue Modal
    grey_background.style.display = 'block';
    popup_dialogue.style.display = 'block';
	// Depending on wether it's add or update:
	if(primary_key == 0) {
		// Just show the ADD form 
    	document.getElementById(datatype).style.display = 'block';
		document.getElementById(datatype + '_submit').value = 'add ' + datatype;
		// if we came from edit form that set this, we have to unset
		document.getElementById('userID').value = primary_key;
	} else {
		// alter ADD form to be an EDIT form 
    	document.getElementById(datatype).style.display = 'block';
		document.getElementById(datatype + '_submit').value = 'edit ' + datatype;
		// Set Hidden value to the ID that needs updating in PHP
		//document.getElementById(datatype + 's_ID').value = primary_key;
		document.getElementById('userID').value = primary_key;
		//Get form data that needs editing
		var url = "ws/admin_ws.php?datatype=" + datatype + "s&id=" + primary_key;
//		console.log(url);
    	$.getJSON(url, function( json_data ) {
//			// pre-populate form names with the keys that came in the json response
			for (var key in json_data) {	
				var outdata = '';
				for(var subkey in json_data[key]) {
					document.getElementById(subkey).value = json_data[key][subkey];
					outdata += subkey + ' ' + json_data[key][subkey] + ' ';
				}
			}		
			console.log(outdata);
		})

		// if(datatype == 'classe') { get teachers list to put in dropdown }
	}
}

function doNotPopup() {
    grey_background.style.display = 'none';
    popup_dialogue.style.display = 'none';
	teacher.style.display = 'none';
	student.style.display = 'none';
	classe.style.display = 'none';
}

function confirmDelete() {
	return confirm("are you sure");
}

function check_uncheck(a_checkbox) {
	var class_of_check = a_checkbox.className;
	class_of_checks = document.getElementsByClassName(class_of_check);

	for(i=0; i < class_of_checks.length; i++) {
		class_of_checks[i].checked = a_checkbox.checked;
	}
}


function formValidate(submission_form) {
	// use http://www.w3schools.com/jsref/dom_obj_all.asp
	if(submission_form.hasChildNodes()) {
		var error = 0;
		var error_msg = '';
		var form_elements = submission_form.childNodes;
		for(i=0;i<form_elements.length;i++) {
			if(form_elements[i].type == 'text'){
				if(form_elements[i].checkValidity()) {
					// don't increment error;
					form_elements[i].style.background = 'lightyellow';
				} else {
					error_msg += "Please enter valid " + form_elements[i].placeholder + "<br/>";
					form_elements[i].style.background = 'red';
					error++;
				}
			}
		}
	}
	if(error>0) {
        error_div.style.display = 'block';
        error_div.innerHTML = error_msg;
		return false;
	} else {
        error_div.style.display = 'none';
		return true;
	}
}
