<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
	
function getOrderDataByID($orderID) {
	$orderData = array();

	// connect to db
        $pdo = getDBConnection();
        
	$sqlPrepared = $pdo->prepare("SELECT OrderID, OrderDate, V.VendorName, DueDate, "
                . "R.RestaurantName " 
                . "FROM tblorder O "
                . "left outer join tblrestaurant R on R.RestaurantID = O.RestaurantID "
                . "left outer join tblvendor V on V.VendorID = O.VendorID "
                . "WHERE OrderID = :rOrderID ");
       
	$sqlPrepared->bindValue(":rOrderID", $orderID); 
	$sqlPrepared->execute();

	if($next = $sqlPrepared->fetch()) {
		$orderData['OrderDate'] = $next['OrderDate'];
		$orderData['VendorName'] = $next['VendorName'];
		$orderData['DueDate'] = $next['DueDate'];
		$orderData['RestaurantName'] = $next['RestaurantName'];
	}
        
        return $orderData;
}
?>
