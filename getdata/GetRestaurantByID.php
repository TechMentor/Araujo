<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
                
	if(isset($_GET['id'])) {
		try {			
                        $pdo = getDBConnection();
			$sqlPrepared = $pdo->prepare("SELECT * FROM tblrestaurant WHERE RestaurantID=:rid");
			$sqlPrepared->bindValue(":rid",$_GET['id']);
			$sqlPrepared->execute();

			if($next = $sqlPrepared->fetch()) {
				htmlout($next['RestaurantName'] . "/-/" . $next['Address1'] . "/-/" . $next['Address2'] . "/-/" . $next['City'] . "/-/" . $next['State'] . "/-/" . $next['ZipCode'] . "/-/" . $next['PhoneNo'] . "/-/" . $next['FaxNo'] . "/-/" . $next['Website']);
			}
		} catch (PDOException $e) {
		}
	}
?>
