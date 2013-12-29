var inventoryEditing = -1;

function currentInventoryAdd() {
    xmlrb = new XMLHttpRequest();
    xmlrb.onreadystatechange = function() {
            if(xmlrb.readyState == 4 && xmlrb.status == 200) {
                    location.reload();
            }
    }    
    xmlrb.open("POST", "../getdata/SaveInventory.php");
    // This is required for PHP in order to populate $_POST
    xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlrb.send("id=" + inventoryEditing +
            "&InventoryDate=" + document.getElementById("inventoryDate").value +
            "&RestaurantID=" + document.getElementById("restaurantID").value +
            "&ProductID=" + document.getElementById("productID").value + 
            "&Quantity=" + document.getElementById("Qty").value  );
}

function inventoryClear() {
	inventoryEditing = -1;

	document.getElementById("inventoryDate").value = date('m-d-y');
	document.getElementById("restaurantID").value = "";
	document.getElementById("productID").value = "";
	document.getElementById("Qty").value = "";
}