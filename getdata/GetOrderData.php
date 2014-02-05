<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetProductsByOrder.php';

session_start();
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
          $orderDateArray = date_parse($next['OrderDate']);
          
            htmlout($next['VendorID'] . "/-/" 
                   . date('Y-m-d', mktime(0,0,0,$orderDateArray["month"],$orderDateArray["day"],$orderDateArray["year"])) . "/-/" 
                   . $next['OrderID'] . "/-/"
                   . date('Y-m-d', mktime(0,0,0,$dueDateArray["month"],$dueDateArray["day"],$dueDateArray["year"])) . "/-/" 
                   . $next['RestaurantID'] );
          
          $_SESSION['OrderSelected'] = array();
          $_SESSION['OrderSelected']['OrderID'] = $next['OrderID'];
          $_SESSION['OrderSelected']['VendorID'] = $next['VendorID'];
          $_SESSION['OrderSelected']['RestaurantID'] = $next['RestaurantID'];
          $_SESSION['OrderSelected']['OrderDate'] = date('Y-m-d', mktime(0,0,0,$orderDateArray["month"],$orderDateArray["day"],$orderDateArray["year"]));
          $_SESSION['OrderSelected']['DueDate'] = date('Y-m-d', mktime(0,0,0,$dueDateArray["month"],$dueDateArray["day"],$dueDateArray["year"]));
	}
      
      /* Get all of the products for the order*/
      
      $_SESSION['ProductsForOrder'] = getProductByOrderData($_GET['id']);
      
    } catch (PDOException $e) {
    }
}
?>
