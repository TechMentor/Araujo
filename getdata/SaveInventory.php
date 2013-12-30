<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

    session_start();
    
    outputToText("SaveInventory.php reached");
    
    if(isset($_POST['InventoryDate'])) {
        try {
            // Save the new Inventory data.
            $pdo = getDBConnection();

            $sqlPrepared = null;
            if($_POST['id'] == -1) {
                $sql = "INSERT INTO tblinventoryhistory (InventoryDate, RestaurantID, ProductID, Quantity, CreatedBy, CreatedOn) values (:rInventoryDate, :rRestaurantID, :rProductID, :rQuantity, :ruser, now())";
                outputToText('Insert sql is ' . $sql);
                $sqlPrepared = $pdo->prepare($sql);
            } else {
                $sql = "UPDATE tblproduct SET " .
                        " InventoryDate = :rInventoryDate, " .
                        " RestaurantID = :rRestaurantID," .
                        " ProductID = :rProductID," .
                        " Quantity = :rQuantity," .
                        " CreatedBy = :ruser, " . 
                        " CreatedOn = now() " .
                        " WHERE IHID = :rid";
                outputToText('Update sql is ' . $sql);
                $sqlPrepared = $pdo->prepare($sql);
                $sqlPrepared->bindValue(":rid",$_POST['id']);
            }

            // for debugging purposes output the prepared statement to the log file.
            outputToText('Hello world; My id is '. $_POST['id']);
            outputToText('$sql is ' . $sql);

            outputToText($_POST['InventoryDate']);
            $sqlPrepared->bindValue(":rInventoryDate",$_POST['InventoryDate']);
            $sqlPrepared->bindValue(":rRestaurantID", $_POST['RestaurantID']);            
            $sqlPrepared->bindValue(":rProductID", $_POST['ProductID']);
            $sqlPrepared->bindValue(":rQuantity", $_POST['Quantity']);                                        
            $sqlPrepared->bindValue(":ruser", $_SESSION['user_id']);
            $sqlPrepared->execute();
            
            outputToText("I ran the query.");
        } catch (Exception $e) {
            htmlout("There was an issue saving an inventory history record.");
            outputToText($e->getTrace());
        }
}

