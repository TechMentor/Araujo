<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
	
	if(isset($_GET['id'])) {
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=techment_araujo', 'techment_zach', 'abcwxy');
			$sqlPrepared = $pdo->prepare("SELECT * FROM tblvendor WHERE VendorID=:rid");
			$sqlPrepared->bindValue(":rid",$_GET['id']);
			$sqlPrepared->execute();

			if($next = $sqlPrepared->fetch()) {
				htmlout($next['VendorName'] . "/-/" . $next['Address1'] . "/-/" . $next['Address2'] . "/-/" . $next['City'] . "/-/" . $next['State'] . "/-/" . $next['ZipCode']);
			}
		} catch (PDOException $e) {
		}
	}
?>
