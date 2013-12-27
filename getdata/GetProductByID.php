<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
                
	if(isset($_GET['id'])) {
		try {			
                        $pdo = getDBConnection();
			$sqlPrepared = $pdo->prepare("SELECT * FROM tblproduct WHERE ProductID=:rid");
			$sqlPrepared->bindValue(":rid",$_GET['id']);
			$sqlPrepared->execute();

			if($next = $sqlPrepared->fetch()) {
				htmlout($next['ProductName'] . "/-/" . $next['CategoryID'] . "/-/" . $next['UnitID'] . "/-/" . $next['ResponsiblePartyID'] . "/-/" . $next['PreferredVendorID'] . "/-/" . $next['Note'] );
			}
		} catch (PDOException $e) {
		}
	}
?>
