function orderSave(id) {
}

function orderClear() {
	xmlrb = new XMLHttpRequest();
        xmlrb.onreadystatechange = function() {
            if(xmlrb.readyState == 4 && xmlrb.status == 200) {
                    location.reload();
            }
        }
    xmlrb.open("POST", "/araujo_tc/getdata/ClearProductToOrder.php");
    // This is required for PHP in order to populate $_POST
    xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlrb.send("");	
}

function addProduct(id) {
	xmlrb = new XMLHttpRequest();
        xmlrb.onreadystatechange = function() {
            if(xmlrb.readyState == 4 && xmlrb.status == 200) {
                    location.reload();
            }
        }
        xmlrb.open("POST", "/araujo_tc/getdata/SaveProductToOrder.php");
        // This is required for PHP in order to populate $_POST
        xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlrb.send("ProductID=" + document.getElementById("ProductID").value
                + "&UnitID=" + document.getElementById("UnitID").value
                + "&Quantity=" + document.getElementById("Quantity").value
                + "&UnitPrice=" + document.getElementById("UnitPrice").value
                + "&ExtPrice=" + document.getElementById("ExtPrice").value
                + "&Comment=" + document.getElementById("Comment").value);
}

function calculateProductPrice() {
    document.getElementById("ExtPrice").value = document.getElementById("UnitPrice").value * document.getElementById("Quantity").value
}