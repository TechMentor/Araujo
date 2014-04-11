<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';

function getInventoryHistoryData() {
    // create global array variable called $inventoryHistory
	$inventoryHistory = array();

    // connect to db
    $pdo = getDBConnection();
    outputPostArrayToText();
    if(isset($_POST['RestaurantID'])){
        outputToText($_POST['RestaurantID']);
    }
    else {
        outputToText('RestaurantID is not set.');         
    };        
    
    $sql = "SELECT IH.IHID, IH.InventoryDate, R.RestaurantName, P.ProductName, U.Unit, IH.Quantity, IH.CreatedBy, IH.CreatedOn " 
            . " FROM tblinventoryhistory IH "
            . " left outer join tblrestaurant R on IH.RestaurantID = R.RestaurantID "
            . " left outer join tblproduct P on IH.ProductID = P.ProductID " 
            . " left outer join tblunit U on P.UnitID = U.UnitID ";
    $sqlWhere = '';
//    if(strlen($inventoryDate)){
//        if( strlen($sqlWhere) > 0) {
//            $sqlWhere = $sqlWhere . ' AND IH.InventoryDate = ' . $inventoryDate;
//        }
//        else {
//            $sqlWhere = $sqlWhere . ' WHERE IH.InventoryDate = ' . $inventoryDate;        
//        }
//    }
//    
    if(isset($_POST['RestaurantID'])){
        if( isset($sqlWhere) ) {
            $sqlWhere = $sqlWhere . ' AND IH.RestaurantID = ' . $_POST['RestaurantID'];
        }
        else {
            $sqlWhere = $sqlWhere . ' WHERE IH.RestaurantID = ' . $_POST['RestaurantID'];
        }
    }
//    
//    if(strlen($product)){
//        if( strlen($sqlWhere) > 0) {
//            $sqlWhere = $sqlWhere . ' AND IH.ProductID = ' . $product;
//        }
//        else {
//            $sqlWhere = $sqlWhere . ' WHERE IH.ProductID = ' . $product;
//        }
//    }
//    
//    if(strlen($qty)){
//        if( strlen($sqlWhere) > 0) {
//            $sqlWhere = $sqlWhere . ' AND IH.Quantity = ' . $qty;
//        }
//        else {
//            $sqlWhere = $sqlWhere . ' WHERE IH.Quantity = ' . $qty;
//        }
//    }
    
    $sql = $sql . $sqlWhere . " ORDER BY IH.IHID DESC";

    $sqlPrepared = $pdo->prepare($sql);
    $sqlPrepared->execute();

    $ct = 0;
    
    while($next = $sqlPrepared->fetch()) {
        $inventoryHistory[$ct] = array();
        $inventoryHistory[$ct]['ID'] = $next['IHID'];
        $inventoryHistory[$ct]['InventoryDate'] = $next['InventoryDate'];
        $inventoryHistory[$ct]['RestaurantName'] = $next['RestaurantName'];
        $inventoryHistory[$ct]['ProductName'] = $next['ProductName'];
        $inventoryHistory[$ct]['Unit'] = $next['Unit'];
        $inventoryHistory[$ct]['Quantity'] = $next['Quantity'];
        $inventoryHistory[$ct]['CreatedBy'] = $next['CreatedBy'];
        $inventoryHistory[$ct]['CreatedOn'] = $next['CreatedOn'];
        $ct++;
    }
    
    return $inventoryHistory;
}
