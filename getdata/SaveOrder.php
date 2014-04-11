<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

    session_start();
    if(isset($_POST['OrderDate'])) {

        try {
            // Save the new Productd data.
            $pdo = getDBConnection();

            $sqlPrepared = null;
            $sql = "INSERT INTO tblorder (OrderDate, VendorID, DueDate, RestaurantID, CreatedBy, CreatedOn) " .
                   "VALUES(:OrderDate, :VendorID, :DueDate, :RestaurantID, :user, :timestamp)";
                //outputToText('Insert sql is ' . $sql);
            $sqlPrepared = $pdo->prepare($sql);
            $sqlPrepared->bindValue(":OrderDate", $_POST['OrderDate']);
            $sqlPrepared->bindValue(":VendorID", $_POST['VendorID']);
            $sqlPrepared->bindValue(":DueDate", $_POST['DueDate']);
            $sqlPrepared->bindValue(":RestaurantID", $_POST['RestaurantID']);
            $sqlPrepared->bindValue(":user", $_SESSION['user_id']);
            $sqlPrepared->bindValue(":timestamp", $timestamp);
            $sqlPrepared->execute();
            
            outputToText('ID of last insert: ' . $pdo->lastInsertId());
            
        } catch (Exception $e) {
            htmlout("There was an issue saving the order.");
            outputToText($e->getTrace());
        }
}