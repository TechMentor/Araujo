var vendorEditing = -1;

function vendorEdit(id) {
	vendorEditing = id;

	xmlra = new XMLHttpRequest();
	xmlra.onreadystatechange = function() {
		if(xmlra.readyState == 4 && xmlra.status == 200) {
			var responseStr = xmlra.response;
			var splitArry = xmlra.response.split("/-/");
			document.getElementById("vendorName").value = splitArry[0];
			document.getElementById("addressOne").value = splitArry[1];
			document.getElementById("addressTwo").value = splitArry[2];
			document.getElementById("city").value = splitArry[3];
			document.getElementById("state").value = splitArry[4];
			document.getElementById("zipCode").value = splitArry[5];
		}
	}
	xmlra.open("GET", "../getdata/GetVendorByID.php?id=" + id);
	xmlra.send();
}

function vendorSave(id) {
        strNote = "id=" + id +
		"&name=" + document.getElementById("vendorName").value +
		"&ad1=" + document.getElementById("addressOne").value +
		"&ad2=" + document.getElementById("addressTwo").value + 
		"&city=" + document.getElementById("city").value + 
		"&state=" + document.getElementById("state").value +
		"&zc=" + document.getElementById("zipCode").value;        
//        console.log(strNote);       

	xmlrb = new XMLHttpRequest();
	xmlrb.onreadystatechange = function() {
		if(xmlrb.readyState === 4 && xmlrb.status === 200) {
			location.reload();
		}
	};
	xmlrb.open("POST", "../getdata/SaveVendor.php");
	// This is required for PHP in order to populate $_POST
	xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlrb.send("id=" + id +
		"&name=" + document.getElementById("vendorName").value +
		"&ad1=" + document.getElementById("addressOne").value +
		"&ad2=" + document.getElementById("addressTwo").value + 
		"&city=" + document.getElementById("city").value + 
		"&state=" + document.getElementById("state").value +
		"&zc=" + document.getElementById("zipCode").value  );
}

function vendorClear() {
	vendorEditing = -1;

	document.getElementById("vendorName").value = "";
	document.getElementById("addressOne").value = "";
	document.getElementById("addressTwo").value = "";
	document.getElementById("city").value = "";
	document.getElementById("state").value = "";
	document.getElementById("zipCode").value = "";
	document.getElementById("editInvLevels").disabled = true;
}