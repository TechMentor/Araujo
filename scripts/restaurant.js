var restaurantEditing = -1;

function restaurantEdit(id) {
	restaurantEditing = id;

	xmlra = new XMLHttpRequest();
	xmlra.onreadystatechange = function() {
		if(xmlra.readyState == 4 && xmlra.status == 200) {
			var splitArry = xmlra.response.split("/-/");
			document.getElementById("restaurantName").value = splitArry[0];
			document.getElementById("addressOne").value = splitArry[1];
			document.getElementById("addressTwo").value = splitArry[2];
			document.getElementById("city").value = splitArry[3];
			document.getElementById("state").value = splitArry[4];
			document.getElementById("zipCode").value = splitArry[5];
			document.getElementById("phoneNo").value = splitArry[6];
			document.getElementById("faxNo").value = splitArry[7];
			document.getElementById("website").value = splitArry[8];
		}
	}
	xmlra.open("GET", "../getdata/GetRestaurantByID.php?id=" + id);
	xmlra.send();

	document.getElementById("editInvLevels").disabled = false;
}

function restaurantSave(id) {
	
	//Save restaurant validation
	
	if (document.getElementById("restaurantName").value == "") {
		var errorString = "\n-Restaurant name is missing";
	} else {
		var errorString = "";
	}
	
	if (document.getElementById("addressOne").value == "") {
		errorString += "\n-Address is missing";
	}
	
	if (document.getElementById("city").value == "") {
		errorString += "\n-City is missing";
	}
	
	if (document.getElementById("state").value == "") {
		errorString += "\n-State is missing";
	}
	
	if (document.getElementById("zipCode").value == "") {
		errorString += "\n-Zip code is missing";
	}
	
	if (document.getElementById("phoneNo").value == "") {
		errorString += "\n-Phone number is missing";
	}
	
	if (document.getElementById("faxNo").value == "") {
		errorString += "\n-Fax number is missing";
	}
	
	if (document.getElementById("website").value == "") {
		errorString += "\n-Website is missing";
	}
	
	var zipCodeEntry = document.getElementById("zipCode").value;
	
	if (/^\d+$/.test(zipCodeEntry)) {
		null;
	} else {
		errorString += "\n-Invalid zipcode. ";
	}
	
	var phoneEntry = document.getElementById("phoneNo").value;
	
	if (/^\d+$/.test(phoneEntry)) {
		null;
	} else {
		errorString += "\n-Invalid phone number.";
	}
	
	var faxEntry = document.getElementById("faxNo").value;
	
	if (/^\d+$/.test(faxEntry)) {
		null;
	} else {
		errorString += "\n-Invalid fax number. ";
	}
	
	if (errorString == "") {
		xmlrb = new XMLHttpRequest();
		xmlrb.onreadystatechange = function() {                
				// alert('response:' + xmlrb.response + '\nStatus:' + xmlrb.status);
					
				if(xmlrb.readyState == 4 && xmlrb.status == 510) {
					alert('response:' + xmlrb.response 
							+ '\nStatus:' + xmlrb.status 
							+ '\nError: ' + xmlrb.response)
				}
				else if(xmlrb.readyState == 4 && xmlrb.status == 200) {
					location.reload();
				}
		}
		xmlrb.open("POST", "../getdata/SaveRestaurant.php");
		// This is required for PHP in order to populate $_POST
		xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlrb.send("id=" + id +
			"&name=" + document.getElementById("restaurantName").value +
			"&ad1=" + document.getElementById("addressOne").value +
			"&ad2=" + document.getElementById("addressTwo").value + 
			"&city=" + document.getElementById("city").value + 
			"&state=" + document.getElementById("state").value +
			"&zc=" + document.getElementById("zipCode").value + 
			"&phno=" + document.getElementById("phoneNo").value + 
			"&fxno=" + document.getElementById("faxNo").value +
			"&url=" + document.getElementById("website").value );
	} else {
		alert('Please fix the following:' + errorString);
		return false;
	}
        
}

function restaurantClear() {
	restaurantEditing = -1;

	document.getElementById("restaurantName").value = "";
	document.getElementById("addressOne").value = "";
	document.getElementById("addressTwo").value = "";
	document.getElementById("city").value = "";
	document.getElementById("state").value = "";
	document.getElementById("zipCode").value = "";
	document.getElementById("phoneNo").value = "";
	document.getElementById("faxNo").value = "";
	document.getElementById("website").value = "";

	document.getElementById("editInvLevels").disabled = true;
}