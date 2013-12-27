<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
	
function getVendorData() {
	// create global array variable called $vendors
	$vendors = array();

	// connect to db
        $pdo = getDBConnection();
        
	$sqlPrepared = $pdo->prepare("SELECT * FROM tblvendor");
	$sqlPrepared->execute();

	$ct = 0;

	while($next = $sqlPrepared->fetch()) {
		$vendors[$ct] = array();
		$vendors[$ct]['ID'] = $next['VendorID'];
		$vendors[$ct]['Name'] = $next['VendorName'];
		$vendors[$ct]['AddressOne'] = $next['Address1'];
		$vendors[$ct]['AddressTwo'] = $next['Address2'];
		$vendors[$ct]['City'] = $next['City'];
		$vendors[$ct]['State'] = $next['State'];
		$vendors[$ct]['ZipCode'] = $next['ZipCode'];
		$vendors[$ct]['CreatedBy'] = $next['CreatedBy'];
		$vendors[$ct]['CreatedOn'] = $next['CreatedOn'];
		$ct++;
	}
        
        return $vendors;
}
?>