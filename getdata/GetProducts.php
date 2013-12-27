<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
	
function getProductData() {
	// create global array variable called $vendors
	$products = array();

	// connect to db
        $pdo = getDBConnection();
        
	$sqlPrepared = $pdo->prepare("SELECT ProductID, ProductName, C.CategoryName, U.Unit, "
                . "R.ResponsibleParty, Note, V.VendorName, P.CreatedBy, P.CreatedOn " 
                . "FROM tblproduct P "
                . "left outer join tblcategory C on P.CategoryID = C.CategoryID "
                . "left outer join tblunit U on P.UnitID = U.UnitID "
                . "left outer join tblresponsibleparty R on P.ResponsiblePartyID = R.ResponsiblePartyID "
                . "left outer join tblvendor V on V.VendorID = P.PreferredVendorID "
                . "ORDER BY P.ProductName ");
	$sqlPrepared->execute();

	$ct = 0;

	while($next = $sqlPrepared->fetch()) {
		$products[$ct] = array();
		$products[$ct]['ID'] = $next['ProductID'];
		$products[$ct]['ProductName'] = $next['ProductName'];
		$products[$ct]['CategoryName'] = $next['CategoryName'];
		$products[$ct]['Unit'] = $next['Unit'];
		$products[$ct]['ResponsibleParty'] = $next['ResponsibleParty'];
		$products[$ct]['Note'] = $next['Note'];
		$products[$ct]['PreferredVendor'] = $next['VendorName'];
		$products[$ct]['CreatedBy'] = $next['CreatedBy'];
		$products[$ct]['CreatedOn'] = $next['CreatedOn'];
		$ct++;
	}
        
        return $products;
}
?>