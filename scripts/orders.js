function orderSave() {
    xmlrb = new XMLHttpRequest();
    xmlrb.onreadystatechange = function() {

        if (xmlrb.readyState == 4 && xmlrb.status == 200) {
            location.reload();
        }
    }

    oid = -1;

    try {
        oid = document.getElementById("OrderID").value;
    } catch (error) {
        oid = 0;
    }

    xmlrb.open("POST", "/araujo_tc/getdata/SaveOrder.php");
    // This is required for PHP in order to populate $_POST
    xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlrb.send("VendorID=" + document.getElementById("VendorID").value
            + "&RestaurantID=" + document.getElementById("RestaurantID").value
            + "&OrderDate=" + document.getElementById("OrderDate").value
            + "&DueDate=" + document.getElementById("DueDate").value
            + "&OrderID=" + oid);
}

function orderUpdate() {
    xmlrb = new XMLHttpRequest();
    xmlrb.onreadystatechange = function() {

        if (xmlrb.readyState == 4 && xmlrb.status == 200) {
            location.reload();
        }
    }

    oid = -1;

    try {
        oid = document.getElementById("OrderID").value;
    } catch (error) {
        oid = 0;
    }

    xmlrb.open("POST", "/araujo_tc/getdata/UpdateOrder.php");
    // This is required for PHP in order to populate $_POST
    xmlrb.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlrb.send("VendorID=" + document.getElementById("VendorID").value
            + "&RestaurantID=" + document.getElementById("RestaurantID").value
            + "&OrderDate=" + document.getElementById("OrderDate").value
            + "&DueDate=" + document.getElementById("DueDate").value
            + "&OrderID=" + oid);
}

function orderClear() {
    xmlrb = new XMLHttpRequest();
    xmlrb.onreadystatechange = function() {

        if (xmlrb.readyState == 4 && xmlrb.status == 200) {
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
        if (xmlrb.readyState == 4 && xmlrb.status == 200) {
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

function orderEdit() {
    orderEditing = document.getElementById("OrderID").value;

    xmlra = new XMLHttpRequest();
    xmlra.onreadystatechange = function() {
        if (xmlra.readyState == 4 && xmlra.status == 200) {
            var responseStr = xmlra.response;
            var splitArry = xmlra.response.split("/-/");
            document.getElementById("VendorID").value = splitArry[0];
            document.getElementById("OrderDate").value = splitArry[1];
            document.getElementById("OrderID").value = splitArry[2];
            document.getElementById("DueDate").value = splitArry[3];
            document.getElementById("RestaurantID").value = splitArry[4];
            location.reload(true);
        }
    }
    xmlra.open("GET", "../../getdata/GetOrderData.php?id=" + orderEditing);
    xmlra.send();
}

function calculateProductPrice() {
    document.getElementById("ExtPrice").value = document.getElementById("UnitPrice").value * document.getElementById("Quantity").value
}