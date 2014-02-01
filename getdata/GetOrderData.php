<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
	
if(isset($_GET['id'])) {
    try {	
	$orders = array();

	// connect to db
      $pdo = getDBConnection();
        
	$sqlPrepared = $pdo->prepare("SELECT OrderID, OrderDate, V.VendorID, DueDate, "
                . "R.RestaurantID " 
                . "FROM tblorder O "
                . "left outer join tblrestaurant R on R.RestaurantID = O.RestaurantID "
                . "left outer join tblvendor V on V.VendorID = O.VendorID "
                . "WHERE OrderID = :orderID "
                . "ORDER BY O.DueDate ");
       
      $sqlPrepared->bindValue(":orderID", $_GET['id']);
	$sqlPrepared->execute();

	while($next = $sqlPrepared->fetch()) {
          $dueDateArray = date_parse($next['DueDate']);
          $orderDateArray = date_parse($next['DueDate']);
          
            htmlout($next['VendorID'] . "/-/" 
                   . date('Y-m-d', mktime(0,0,0,$orderDateArray["month"],$orderDateArray["day"],$orderDateArray["year"])) . "/-/" 
                   . $next['OrderID'] . "/-/" 
                   . date('Y-m-d', mktime(0,0,0,$dueDateArray["month"],$dueDateArray["day"],$dueDateArray["year"])) . "/-/" 
                   . $next['RestaurantID'] );
	}
    } catch (PDOException $e) {
    }
}
?>
