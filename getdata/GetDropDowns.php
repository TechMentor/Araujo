<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
    
function populateDropDown($queryName, $IncludeNone = 1){ 
    htmlout('Hello world' . $queryName);
        
    switch($queryName){
        case "Categories":
            $strSQL = "SELECT CategoryID as ID, CategoryName as FriendlyValue FROM tblcategory";
            break;
        case "Units":
            $strSQL = "SELECT UnitID as ID, Unit as FriendlyValue FROM tblunit";
            break;
        case "Products":
            $strSQL = "SELECT ProductID as ID, ProductName as FriendlyValue FROM tblproduct";
            break;
        case "ResponsibleParties":
            $strSQL = "SELECT ResponsiblePartyID as ID, ResponsibleParty as FriendlyValue FROM tblresponsibleparty";
            break;
        case "Restaurants":
            $strSQL = "SELECT RestaurantID as ID, RestaurantName as FriendlyValue FROM tblrestaurant";
            break;
        case "Vendors":
            $strSQL = "SELECT VendorID as ID, VendorName as FriendlyValue FROM tblvendor order by VendorName";
            break;
    }
    
    if($IncludeNone == 1){
        echo '<option value ="0">-none-</option>';
    }
    
    $pdo = getDBConnection();    
    $Record = $pdo->query($strSQL);  
    foreach ($Record as $row){
        echo '<option value="' . $row['ID'] .'">' . $row['FriendlyValue'] . '</option>';
    };
    htmlout('Goodbye world');
}    
?>