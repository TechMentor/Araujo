<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

    session_start();
    if(isset($_POST['ProductName'])) {

        try {
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
//            outputToText('Hello world; My id is '. $_POST['id']);
//            outputToText('$sql is ' . $sql);
//            outputToText($sqlPrepared);

//            $sqlPrepared->bindValue(":rProductName",NULLIF($_POST['ProductName'],0));            
            $sqlPrepared->bindValue(":rCategoryID",NULLIF($_POST['CategoryID'],0));
            $sqlPrepared->bindValue(":rUnitID",NULLIF($_POST['UnitID'],0));
            $sqlPrepared->bindValue(":rResponsiblePartyID",NULLIF($_POST['ResponsiblePartyID'],0));
            $sqlPrepared->bindValue(":rPreferredVendorID",NULLIF($_POST['PreferredVendorID'],0));
            $sqlPrepared->bindValue(":rNote",NULLIF($_POST['Note'],0));
            $sqlPrepared->bindValue(":ruser",$_SESSION['user_id']);

//            $sqlPrepared->bindValue(":rProductName",$_POST['ProductName']);            
//            $sqlPrepared->bindValue(":rCategoryID", $_POST['CategoryID']);
//            $sqlPrepared->bindValue(":rUnitID", $_POST['UnitID']);
//            $sqlPrepared->bindValue(":rResponsiblePartyID", $_POST['ResponsiblePartyID']);
//            $sqlPrepared->bindValue(":rPreferredVendorID", $_POST['PreferredVendorID']);
//            $sqlPrepared->bindValue(":rNote", $_POST['Note']);
//            $sqlPrepared->bindValue(":ruser", $_SESSION['user_id']);

            
            $sqlPrepared->execute();
            
            outputToText("I ran the query.");
        } catch (Exception $e) {
            htmlout("There was an issue saving a vendor.");
            outputToText($e->getTrace());
        }
}

