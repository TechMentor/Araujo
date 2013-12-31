var inventoryEditing = -1;

function currentInventoryAdd() {
    xmlrb = new XMLHttpRequest();
    xmlrb.onreadystatechange = function() {            
       // alert('Ready state has changed to ' + xmlrb.readyState + "\n" + ' and status is ' + xmlrb.status + '.');
        if(xmlrb.readyState == 4 && xmlrb.status == 200) {
            //alert('Ready state has changed to ' + xmlrb.readyState + "\n" + ' and status is ' + xmlrb.status + '.');
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

function inventoryFilterClear() {
        document.getElementById("filter_restaurantID").selectedIndex = 0;
        document.getElementById("filter_productID").selectedIndex = 0;
	document.getElementById("filter_Qty").value = "";
        document.getElementById("filter_inventoryDate").value = '';  //date('m/d/y');
	inventoryEditing = -1;  
//      document.getElementById("inventoryHistoryFilter").onsubmit="return false;"      
}