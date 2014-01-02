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
                   "VALUES(:OrderDate, :VendorID, :DueDate, :RestaurantID, :user, now())";
                //outputToText('Insert sql is ' . $sql);
            $sqlPrepared = $pdo->prepare($sql);
            $sqlPrepared->bindValue(":OrderDate", $_POST['OrderDate']);
            $sqlPrepared->bindValue(":VendorID", $_POST['VendorID']);
            $sqlPrepared->bindValue(":DueDate", $_POST['DueDate']);
            $sqlPrepared->bindValue(":RestaurantID", $_POST['RestaurantID']);
            $sqlPrepared->bindValue(":user", $_SESSION['user_id']);
            $sqlPrepared->execute();
            
            for($i = 0; $i < count($_SESSION['ProductsForOrder']); $i++) {
                $sql = "INSERT INTO tblorderproduct (OrderID, ProductID, UnitPrice, Quantity, Comment) " .
                   "VALUES (:OrderID, :ProductID, :UnitPrice, :Quantity, :Comment)";
                
                $tProduct = $_SESSION['ProductsForOrder'][$i];
                $sqlPrepared = null;
                
                $sqlPrepared = $pdo->prepare($sql);
                $sqlPrepared->bindValue(":OrderID", 1);
                $sqlPrepared->bindValue(":ProductID", $tProduct['ProductID']);
                $sqlPrepared->bindValue(":UnitPrice", $tProduct['UnitPrice']);
                $sqlPrepared->bindValue(":Quantity", $tProduct['Quantity']);
                $sqlPrepared->bindValue(":Comment", $tProduct['Comment']);
                $sqlPrepared->execute();
            }
            
            $_SESSION['ProductsForOrder'] = array();
            
        } catch (Exception $e) {
            htmlout("There was an issue saving the order.");
            outputToText($e->getTrace());
        }
}

