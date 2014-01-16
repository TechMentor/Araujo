<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
	
function getOrderData() {
	$orders = array();

	// connect to db
        $pdo = getDBConnection();
        
	$sqlPrepared = $pdo->prepare("SELECT OrderID, OrderDate, V.VendorName, DueDate, "
                . "R.RestaurantName " 
                . "FROM tblorder O "
                . "left outer join tblrestaurant R on R.RestaurantID = O.RestaurantID "
                . "left outer join tblvendor V on V.VendorID = O.VendorID "
                . "ORDER BY O.DueDate ");
       
	$sqlPrepared->execute();

	$ct = 0;

	while($next = $sqlPrepared->fetch()) {
		$orders[$ct] = array();
		$orders[$ct]['OrderID'] = $next['OrderID'];
		$orders[$ct]['OrderDate'] = $next['OrderDate'];
		$orders[$ct]['VendorName'] = $next['VendorName'];
		$orders[$ct]['DueDate'] = $next['DueDate'];
		$orders[$ct]['RestaurantName'] = $next['RestaurantName'];
		$ct++;
	}
        
        return $orders;
}
?>
