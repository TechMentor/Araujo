<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
	
function getOrderData($id) {
	$orders = array();

	// connect to db
        $pdo = getDBConnection();
        
	$sqlPrepared = $pdo->prepare("SELECT OrderID, OrderDate, V.VendorID, DueDate, "
                . "R.RestaurantID " 
                . "FROM tblorder O "
                . "left outer join tblrestaurant R on R.RestaurantID = O.RestaurantID "
                . "left outer join tblvendor V on V.VendorID = O.VendorID "
                . "WHERE OrderID = :orderID"
                . "ORDER BY O.DueDate ");
       
        $sqlPrepared->bindValue(":orderID", $id);
	$sqlPrepared->execute();

	$ct = 0;

	while($next = $sqlPrepared->fetch()) {
            $_SESSION['OrderData']['Vendor'] = $next['VendorID'];
            $_SESSION['OrderData']['OrderDate'] = $next['OrderDate'];
            $_SESSION['OrderData']['OrderID'] = $next['OrderID'];
            $_SESSION['OrderData']['DueDate'] = $next['DueDate'];
            $_SESSION['OrderData']['RestaurantID'] = $next['RestaurantID'];
	}
}
?>
