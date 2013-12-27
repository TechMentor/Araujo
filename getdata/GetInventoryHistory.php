<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	

function getInventoryHistoryData() {
    // create global array variable called $inventoryHistory
	$inventoryHistory = array();

    // connect to db
    $pdo = getDBConnection();

    $sqlPrepared = $pdo->prepare("SELECT IH.IHID, IH.InventoryDate, R.RestaurantName, P.ProductName, U.Unit, IH.Quantity, IH.CreatedBy, IH.CreatedON " 
            . " FROM tblinventoryhistory IH "
            . " left outer join tblrestaurant R on IH.RestaurantID = R.RestaurantID "
            . " left outer join tblproduct P on IH.ProductID = P.ProductID " 
            . " left outer join tblunit U on P.UnitID = U.UnitID "
            . " ORDER BY IH.IHID DESC");
    $sqlPrepared->execute();

    $ct = 0;
    
    while($next = $sqlPrepared->fetch()) {
        $inventoryHistory[$ct] = array();
        $inventoryHistory[$ct]['ID'] = $next['InventoryDate'];
        $inventoryHistory[$ct]['InventoryDate'] = $next['InventoryDate'];
        $inventoryHistory[$ct]['RestaurantName'] = $next['RestaurantName'];
        $inventoryHistory[$ct]['ProductName'] = $next['ProductName'];
        $inventoryHistory[$ct]['Unit'] = $next['Unit'];
        $inventoryHistory[$ct]['Quantity'] = $next['Quantity'];
        $inventoryHistory[$ct]['CreatedBy'] = $next['CreatedBy'];
        $inventoryHistory[$ct]['CreatedON'] = $next['CreatedON'];
        $ct++;
    }
    
    return $inventoryHistory;
}
