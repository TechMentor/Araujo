<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

    session_start();
    outputToText('Running Save Product');
//    outputToText('productName is ' . $_POST['ProductName']);
//    outputToText('id is ' . $_POST['id']);
    
//    foreach ($_POST as $key => $entry){
//         outputToText($key . ": " . $entry);
//    }
    
    if(isset($_POST['ProductName'])) {        
        try {            
//            outputToText('Trying SaveProduct');
            
            // Save the new Productd data.
            $pdo = getDBConnection();

            $sqlPrepared = null;
            if($_POST['id'] == -1) {
                $sql = "INSERT INTO tblproduct (ProductName, CategoryID, UnitID, ResponsiblePartyID, PreferredVendorID, Note, CreatedBy, CreatedOn) values (:rProductName, :rCategoryID, :rUnitID, :rResponsiblePartyID, :rPreferredVendorID, :rNote, :ruser, now())";
                outputToText('Insert sql is ' . $sql);
                $sqlPrepared = $pdo->prepare($sql);
            } else {
                $sql = "UPDATE tblproduct SET " .
                        " ProductName = :rProductName, " .
                        " CategoryID = :rCategoryID," .
                        " UnitID = :rUnitID," .
                        " ResponsiblePartyID = :rResponsiblePartyID," .
                        " PreferredVendorID = :rPreferredVendorID," .
                        " Note = :rNote," .
                        " CreatedBy = :ruser, " . 
                        " CreatedOn = now() " .
                        " WHERE ProductID = :rid";
                htmlout(">".$_POST['id']."<");
                outputToText('Update sql is ' . $sql);
                $sqlPrepared = $pdo->prepare($sql);
                $sqlPrepared->bindValue(":rid",$_POST['id']);
            }

            // for debugging purposes output the prepared statement to the log file.
            outputToText('Hello world; My id is '. $_POST['id']);
            outputToText('$sql is ' . $sql);
            // outputToText('$sqlPrepared is ' . $sqlPrepared);

            if(strlen($_POST['ProductName'])==0){                
                $sqlPrepared->bindValue(":rProductName", null);
            } else {
                $sqlPrepared->bindValue(":rProductName",$_POST['ProductName']);
            }
            
            if($_POST['CategoryID'] == 0){
                $sqlPrepared->bindValue(":rCategoryID", null);
            } else {
                $sqlPrepared->bindValue(":rCategoryID", $_POST['CategoryID']);
            }
            outputToText('rCategoryID is ' . nullif($_POST['CategoryID'], 0));               
            
            
            if($_POST['UnitID'] == 0){
                $sqlPrepared->bindValue(":rUnitID", null);
            } else {
                $sqlPrepared->bindValue(":rUnitID", $_POST['UnitID']);
            }
            
            if($_POST['ResponsiblePartyID']==0){
                $sqlPrepared->bindValue(":rResponsiblePartyID", null);
            } else {
                outputToText('ResponsiblePartyID is ' . $_POST['ResponsiblePartyID']);
                $sqlPrepared->bindValue(":rResponsiblePartyID", $_POST['ResponsiblePartyID']);                
            }
            
            if($_POST['PreferredVendorID']==0){
                $sqlPrepared->bindValue(":rPreferredVendorID", null);
            } else {
                $sqlPrepared->bindValue(":rPreferredVendorID", $_POST['PreferredVendorID']);                
            }
            
            if($_POST['Note']==''){
                $sqlPrepared->bindValue(":rNote", null);
            } else {
                $sqlPrepared->bindValue(":rNote", $_POST['Note']);
            }
            
            $sqlPrepared->bindValue(":ruser", $_SESSION['user_id']);
            $sqlPrepared->execute();
            
            outputToText("I ran the query.");
        } catch (Exception $e) {
            outputToText('catching SaveProduct');
            htmlout("There was an issue saving a product.");
            outputToText($e->getTrace());
        }
}

