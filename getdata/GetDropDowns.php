<?php
    
function populateDropDown($queryName){ 
    htmlout('Hello world' . $queryName);
        
    switch($queryName){
        case "Categories":
            $strSQL = "SELECT CategoryID as ID, CategoryName as FriendlyValue FROM tblcategory";
            break;
        case "Units":
            $strSQL = "SELECT UnitID as ID, Unit as FriendlyValue FROM tblunit";
            break;
        case "ResponsibleParties":
            $strSQL = "SELECT ResponsiblePartyID as ID, ResponsibleParty as FriendlyValue FROM tblresponsibleparty";
            break;
        case "Vendors":
            $strSQL = "SELECT VendorID as ID, VendorName as FriendlyValue FROM tblvendor order by VendorName";
            break;
    }
    
    // The following works to create the pdf, but I would rather include the dbconnect.inc.php file.  Unfortunately that didn't work.  Why?
    $pdo = new PDO('mysql:host=localhost;dbname=techment_araujo', 'techment_zach', 'abcwxy');
    
    $Record = $pdo->query($strSQL);  
    foreach ($Record as $row){
        echo '<option value="' . $row['ID'] .'">' . $row['FriendlyValue'] . '</option>';
    };
    htmlout('Goodbye world');
}    
?>