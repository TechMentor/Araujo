var productEditing = -1;

function productEdit(id) {
	productEditing = id;

	xmlra = new XMLHttpRequest();
	xmlra.onreadystatechange = function() {
		if(xmlra.readyState == 4 && xmlra.status == 200) {
			var responseStr = xmlra.response;
			var splitArry = xmlra.response.split("/-/");
			document.getElementById("ProductName").value = splitArry[0];
			document.getElementById("CategoryID").value = splitArry[1];
			document.getElementById("UnitID").value = splitArry[2];
			document.getElementById("ResponsiblePartyID").value = splitArry[3];
			document.getElementById("PreferredVendorID").value = splitArry[4];
			document.getElementById("Note").value = splitArry[5];
		}
	}
	xmlra.open("GET", "../getdata/GetProductByID.php?id=" + id);
	xmlra.send();
}

function productSave(id) {
    xmlrb = new XMLHttpRequest();
    xmlrb.onreadystatechange = function() {
            if(xmlrb.readyState == 4 && xmlrb.status == 200) {
                    location.reload();
            }
    }
    xmlrb.open("POST", "../getdata/SaveProduct.php");
    // This is required for PHP in order to populate $_POST
    xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlrb.send("id=" + productEditing +
            "&ProductName=" + document.getElementById("ProductName").value +
            "&CategoryID=" + document.getElementById("CategoryID").value +
            "&UnitID=" + document.getElementById("UnitID").value + 
            "&ResponsiblePartyID=" + document.getElementById("ResponsiblePartyID").value + 
            "&PreferredVendorID=" + document.getElementById("PreferredVendorID").value +
            "&Note=" + document.getElementById("Note").value  );
}

function productClear() {
	productEditing = -1;

	document.getElementById("ProductName").value = "";
	document.getElementById("CategoryID").value = "";
	document.getElementById("UnitID").value = "";
	document.getElementById("ResponsiblePartyID").value = "";
	document.getElementById("PreferredVendorID").value = "";
	document.getElementById("Note").value = "";
}