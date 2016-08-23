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

/*	
	error = 0;
    error_div.innerHTML = '';

    if(username.checkValidity()) {
        username.style.background = 'lightyellow';
    } else {
        error_div.innerHTML += 'Username must be 8 or more characters only<br/>';
        username.style.background = 'red';
        error++;
    }

    if(password.checkValidity()) {
        password.style.background = 'lightyellow';
    } else {
        error_div.innerHTML += 'Password must be 8 or more characters mixed case with numbers<br/>';
        password.style.background = 'red';
        error++;
	}

    //if all validation checks out return true, otherwise display error_div and falsify;
    if(error == 0) {
        error_div.style.display = 'none';
    	return true;
    } else {
        error_div.style.display = 'block';
        return false;
    }
*/
