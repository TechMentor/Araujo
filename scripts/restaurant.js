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