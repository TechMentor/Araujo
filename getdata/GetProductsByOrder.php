<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';	
	
function getProductByOrderData($orderID) {
	// create global array variable called $vendors
	$products = array();

	// connect to db
        $pdo = getDBConnection();
        
	$sqlPrepared = $pdo->prepare("SELECT P.ProductID, ProductName, OP.Quantity, OP.UnitPrice, "
                . "U.UnitID, R.ResponsibleParty, Note, V.VendorName, P.CreatedBy, P.CreatedOn " 
                . "FROM tblproduct P "
                . "left outer join tblcategory C on P.CategoryID = C.CategoryID "
                . "left outer join tblunit U on P.UnitID = U.UnitID "
                . "left outer join tblresponsibleparty R on P.ResponsiblePartyID = R.ResponsiblePartyID "
                . "left outer join tblvendor V on V.VendorID = P.PreferredVendorID "
                . "left outer join tblorderproduct OP on P.ProductID = OP.ProductID "
                . "WHERE OP.OrderID = :rOrderID "
                . "ORDER BY P.ProductName ");
       
        $sqlPrepared->bindValue(":rOrderID", $orderID);        
	$sqlPrepared->execute();

	$ct = 0;

	while($next = $sqlPrepared->fetch()) {
		$products[$ct] = array();
		$products[$ct]['ProductID'] = $next['ProductID'];
            $products[$ct]['UnitID'] = $next['UnitID'];
		$products[$ct]['ProductName'] = $next['ProductName'];
		$products[$ct]['Quantity'] = $next['Quantity'];
		$products[$ct]['UnitPrice'] = $next['UnitPrice'];
            $products[$ct]['Comment'] = $next['Note'];
            $products[$ct]['ExtPrice'] = $products[$ct]['Quantity'] * $products[$ct]['UnitPrice'];
		$ct++;
	}
        
        return $products;
}
?>
