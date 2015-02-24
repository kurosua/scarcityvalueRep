// Checks forms for blanks: radio buttons, text fields, and select/options only.

function valform(thisform) {

	while (thisform.nodeName != "FORM") {
		thisform = thisform.parentNode;
	}


	var inputarr = thisform.getElementsByTagName("input");
	var i; var chex = 0; var boxArray = new Array();

	for (i = 0; i < inputarr.length; i++) {
		if (chex == 0) {
			if (inputarr[i].type == "text") {
				if (inputarr[i].value == "") {
					alert("You must fill out the field: " + inputarr[i].name);
					chex = 1;
				}
			}
			if (inputarr[i].type == "radio") {
				if (inputarr[i].checked) {
					boxArray[inputarr[i].name] = 1;
				}
				if (!(inputarr[i].checked)) {
					if (boxArray[inputarr[i].name] != 1) {
						boxArray[inputarr[i].name] = 0;
					}
				}
			}
		}
	}
	
	for (var boxName in boxArray) {
		if (chex == 0) {
			if (boxArray[boxName] == 0) {
				alert("You must fill out the field: " + boxName);
				chex = 1;
			}
		}
	}

	var selectarray = thisform.getElementsByTagName("select");

	for (i = 0; i < selectarray.length; i++) {
		if (chex == 0) {
			if (selectarray[i].value == "") {
				alert("You must fill out the field: " + selectarray[i].name);
				chex = 1;
			}
		}
	}

	if (chex == 0) {
		thisform.submit();
	}

}