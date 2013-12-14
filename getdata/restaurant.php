<?php
	$restaurants = array();
	getRestaurantData();	

function getRestaurantData() {
	// import into this function the global array variable named $restaurants - see N2N p179
	global $restaurants;

	// connect to db
	include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/db.inc.php';

	// create a prepared statement to get the records from the restaraunt table.
	$sqlPrepared = $pdo->prepare("SELECT * FROM tblrestaurant");
	
	// execute the prepared statement
	$sqlPrepared->execute();

	// create a counter variable
	$ct = 0;

	// loop through each record in the prepared statements recordset
	while($next = $sqlPrepared->fetch()) {
		$restaurants[$ct] = array();
		$restaurants[$ct]['ID'] = $next['RestaurantID'];
		$restaurants[$ct]['Name'] = $next['RestaurantName'];
		$restaurants[$ct]['AddressOne'] = $next['Address1'];
		$restaurants[$ct]['AddressTwo'] = $next['Address2'];
		$restaurants[$ct]['City'] = $next['City'];
		$restaurants[$ct]['State'] = $next['State'];
		$restaurants[$ct]['ZipCode'] = $next['ZipCode'];
		$restaurants[$ct]['PhoneNo'] = $next['PhoneNo'];
		$restaurants[$ct]['FaxNo'] = $next['FaxNo'];
		$restaurants[$ct]['Website'] = $next['Website'];
		$ct++;
	}
}
?>