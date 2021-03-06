<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/restaurant.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetVendors.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetProducts.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetProductsByOrder.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetInventoryHistory.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetOrders.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetOrdersByID.php';

function getTable($tableType, $search = NULL) {
    switch($tableType) {
        case "InventoryHistory":
            getInventoryHistoryTable();
            break;
        case "Products":
            getProductTable($search);
            break;
        case "Restaurants":
            getRestaurantTable();
            break;
        case "Vendors":
            getVendorTable();
            break;
	case "Orders":
            getOrderTable();
            break;
	case "Order Detail":
            getOrderDetailTable($search);
            break;
    }
}

function getInventoryHistoryTable() {
    echo '<table border="1">';
    echo '<tr>';
    echo '<td>Date</td>';
    echo '<td>Restaurant</td>';
    echo '<td>Product</td>';    
    echo '<td>Units</td>';
    echo '<td>Qty</td>';
//    echo '<td>Created By</td>';
//    echo '<td>Created On</td>';
    echo '</tr>';
    
    $inventoryHistory = getInventoryHistoryData();
    
    for ($i = 0; $i < count($inventoryHistory); $i++) {
        echo '<tr>';
        echo '<td>' . $inventoryHistory[$i]['InventoryDate'] . '</td>';
        echo '<td>' . $inventoryHistory[$i]['RestaurantName'] . '</td>';
        echo '<td>' . $inventoryHistory[$i]['ProductName'] . '</td>';
        echo '<td>' . $inventoryHistory[$i]['Unit'] . '</td>';
        echo '<td>' . $inventoryHistory[$i]['Quantity'] . '</td>';
//        echo '<td>' . $inventoryHistory[$i]['CreatedBy'] . '</td>';
//        echo '<td>' . $inventoryHistory[$i]['CreatedOn'] . '</td>';
//        echo '<td><button name="'. 'eButton' . $i . '" onClick="inventoryHistoryEdit(' . $inventoryHistory[$i]['ID'] . ')">Edit</button></td>';
        echo '</tr>';
    }
    echo '</table>';
}

function getProductTable($search = NULL) {
    echo '<table border="1">';
    echo '<tr>';
    echo '<td>Product</td>';
    echo '<td>Category</td>';
    echo '<td>Unit</td>';
    echo '<td>Responsible Party</td>';
    echo '<td>Preferred Vendor</td>';
    echo '<td>Note</td>';
    echo '<td>Edit</td>';
    echo '</tr>';
    
    $products = getProductData($search);
    
    for($i = 0; $i < count($products); $i++) {
        echo '<tr>';
        echo '<td>' . $products[$i]['ProductName'] . '</td>';
        echo '<td>' . $products[$i]['CategoryName'] . '</td>';
        echo '<td>' . $products[$i]['Unit'] . '</td>';
        echo '<td>' . $products[$i]['ResponsibleParty'] . '</td>';
        echo '<td>' . $products[$i]['PreferredVendor'] . '</td>';
        echo '<td>' . $products[$i]['Note'] . '</td>';
        echo '<td><button name="'. 'eButton' . $i . '" onClick="productEdit(' . $products[$i]['ID'] . ')">Edit</button></td>';
        echo '</tr>';
    }
    echo '</table>';
}

function getRestaurantTable() {
    echo '<table border="1">';
    echo '<tr>';
    echo '<td>Restaurant</td>';
    echo '<td>Address</td>';
    echo '<td>City</td>';
    echo '<td>State</td>';
    echo '<td>Zip</td>';
    echo '<td>Phone #</td>';
    echo '<td>Fax #</td>';
    echo '<td>Website</td>';
    echo '<td>Edit</td>';
    echo '</tr>';
    
    $restaurants = getRestaurantData();
    
    for($i = 0; $i < count($restaurants); $i++) {
        echo '<tr>';
        echo '<td>' . $restaurants[$i]['Name'] . '</td>';
        echo '<td>' . trim($restaurants[$i]['AddressOne'] . " " . $restaurants[$i]['AddressTwo']) . '</td>';
        echo '<td>' . $restaurants[$i]['City'] . '</td>';
        echo '<td>' . $restaurants[$i]['State'] . '</td>';
        echo '<td>' . $restaurants[$i]['ZipCode'] . '</td>';
        echo '<td>' . $restaurants[$i]['PhoneNo'] . '</td>';
        echo '<td>' . $restaurants[$i]['FaxNo'] . '</td>';
        echo '<td>' . $restaurants[$i]['Website'] . '</td>';
        echo '<td><button name="'. 'eButton' . $i . '" onClick="restaurantEdit(' . $restaurants[$i]['ID'] . ')">Edit</button></td>';
        echo '</tr>';
    }
    echo '</table>';
}

function getVendorTable() {
    echo '<table border="1">';
    echo '<tr>';
    echo '<td>Vendor</td>';
    echo '<td>Address 1</td>';
    echo '<td>Address 2</td>';
    echo '<td>City</td>';
    echo '<td>State</td>';
    echo '<td>Zip Code</td>';
    echo '<td>Edit</td>';
    echo '</tr>';
    
    $vendors = getVendorData();
    
    for($i = 0; $i < count($vendors); $i++) {
        echo '<tr>';
        echo '<td>' . $vendors[$i]['Name'] . '</td>';
        echo '<td>' . trim($vendors[$i]['AddressOne']) . '</td>';
        echo '<td>' . trim($vendors[$i]['AddressTwo']) . '</td>';
        echo '<td>' . trim($vendors[$i]['City']) . '</td>';
        echo '<td>' . trim($vendors[$i]['State']) . '</td>';
        echo '<td>' . trim($vendors[$i]['ZipCode']) . '</td>';
        echo '<td><button name="'. 'eButton' . $i . '" onClick="vendorEdit(' . $vendors[$i]['ID'] . ')">Edit</button></td>';
        echo '</tr>';
    }
    echo '</table>';
}

function getOrderTable() {
    echo '<table border="1">';
    echo '<tr>';
    echo '<td>Order #</td>';
    echo '<td>Order Date</td>';
    echo '<td>Vendor Name</td>';
    echo '<td>Due Date</td>';
    echo '<td>Restaurant Name</td>';
    echo '</tr>';
    
    $orders = getOrderData();
    
    for($i = 0; $i < count($orders); $i++) {
        echo '<tr>';
        echo '<td>';
            echo '<a href="/araujo_tc/orders/detailed/index.php?id=' . $orders[$i]['OrderID'] . '">';
            echo $orders[$i]['OrderID'];
            echo '</a>';
        echo '</td>';
        echo '<td>' . $orders[$i]['OrderDate'] . '</td>';
        echo '<td>' . $orders[$i]['VendorName'] . '</td>';
        echo '<td>' . $orders[$i]['DueDate'] . '</td>';
        echo '<td>' . $orders[$i]['RestaurantName'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function getOrderDetailTable($orderid) {
    $orderData = getOrderDataByID($orderid);
    echo 'Order Date: ' . $orderData['OrderDate'] . '<br>';
    echo 'Due Date: ' . $orderData['DueDate'] . '<br>';
    echo 'Vendor: ' . $orderData['VendorName'] . '<br>';
    echo 'Restaurant: ' . $orderData['RestaurantName'] . '<br>';

    echo '<br><br>';

    $orderTotal = 0;

    echo '<table border="1">';
    echo '<tr>';
    echo '<td><b>Product Name</b></td>';
    echo '<td><b>Product Price</b></td>';
    echo '<td><b>Total Price</b></td>';
    echo '</tr>';
    
    $products = getProductByOrderData($orderid);
    
    for($i = 0; $i < count($products); $i++) {
        echo '<tr>';
        echo '<td>' . $products[$i]['ProductName'] . '</td>';
        echo '<td>' . $products[$i]['Quantity'] . ' @ ' . ' $' . $products[$i]['UnitPrice'] . '</td>';
        echo '<td>' . '$' . $products[$i]['Quantity'] * $products[$i]['UnitPrice'] . '</td>';
	$orderTotal += $products[$i]['Quantity'] * $products[$i]['UnitPrice'];
        echo '</tr>';
    }

        echo '<tr>';
        echo '<td colspan=2>' . '<b>Total:</b>' . '</td>';
        echo '<td>' . '<b>$' . $orderTotal . '</b></td>';
        echo '</tr>';
    echo '</table>';
}


function getCurrentOrderTable() {
    echo '<table border="1">';    
    echo '<tr>';
    echo '<td>Product Name</td>';
    echo '<td>Unit Name</td>';
    echo '<td>Quantity</td>';
    echo '<td>Unit Price</td>';
    echo '<td>Ext Price</td>';
    echo '<td>Comment</td>';
    echo '<td></td>';
    echo '</tr>';
    
    if(!isset($_SESSION['ProductsForOrder'])) { return; }
    
    for($i = 0; $i < count($_SESSION['ProductsForOrder']); $i++) {
        echo '<tr>';
        echo '<td>' . $_SESSION['ProductsForOrder'][$i]['ProductName'] . '</td>';
        echo '<td>' . $_SESSION['ProductsForOrder'][$i]['UnitName'] . '</td>';
        echo '<td>' . $_SESSION['ProductsForOrder'][$i]['Quantity'] . '</td>';
        echo '<td>' . $_SESSION['ProductsForOrder'][$i]['UnitPrice'] . '</td>';
        echo '<td>' . $_SESSION['ProductsForOrder'][$i]['ExtPrice'] . '</td>';
        echo '<td>' . $_SESSION['ProductsForOrder'][$i]['Comment'] . '</td>';
        echo '<td><button onclick="removeProduct('. $i .')">Remove</button></td>';
        echo '</tr>';
    }
    echo '</table>';
}

function getCurrentOrderTotal() {
    $total = 0;
    
    if(!isset($_SESSION['ProductsForOrder'])) {
        echo 0;
        return;
    }
        
    for($i = 0; $i < count($_SESSION['ProductsForOrder']); $i++) {
        $total += $_SESSION['ProductsForOrder'][$i]['ExtPrice'];
    }
    
    echo $total;
}
