<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

    session_start();
    if(isset($_POST['OrderDate'])) {

        htmlout($_POST['OrderID']);
        
        try {
            // Save the new Productd data.
            $pdo = getDBConnection();

            $timestamp = date('Y-m-d H:i:s');
            
            $sqlPrepared = null;
            $sql = "Update tblorder set OrderDate = :OrderDate, "
                    . "VendorID = :VendorID, DueDate = :DueDate, "
                    . "RestaurantID = :RestaurantID, CreatedBy = :user, "
                    . "CreatedOn = :timestamp WHERE OrderID = :OrderID ";
                //outputToText('Insert sql is ' . $sql);
            $sqlPrepared = $pdo->prepare($sql);
            $sqlPrepared->bindValue(":OrderID", $_POST['OrderID']);
            $sqlPrepared->bindValue(":OrderDate", $_POST['OrderDate']);
            $sqlPrepared->bindValue(":VendorID", $_POST['VendorID']);
            $sqlPrepared->bindValue(":DueDate", $_POST['DueDate']);
            $sqlPrepared->bindValue(":RestaurantID", $_POST['RestaurantID']);
            $sqlPrepared->bindValue(":user", $_SESSION['user_id']);
            $sqlPrepared->bindValue(":timestamp", $timestamp);
            $sqlPrepared->execute();
            
            $sqlPrepared = null;
            $sql = "SELECT * FROM tblorder WHERE CreatedOn LIKE :timestamp";
                //outputToText('Insert sql is ' . $sql);
            $sqlPrepared = $pdo->prepare($sql);
            $sqlPrepared->bindValue(":timestamp", '%'. $timestamp .'%');
            $sqlPrepared->execute();
            
            $orderid = 0;
            
            if($next = $sqlPrepared->fetch()) {
                $orderid = $next['OrderID'];
            } else {
                throw new Exception("Error finding the order just created", '', '');
            }
            
            /*for($i = 0; $i < count($_SESSION['ProductsForOrder']); $i++) {
                $sql = "INSERT INTO tblorderproduct (OrderID, ProductID, UnitPrice, Quantity, Comment) " .
                   "VALUES (:OrderID, :ProductID, :UnitPrice, :Quantity, :Comment)";
                
                $tProduct = $_SESSION['ProductsForOrder'][$i];
                $sqlPrepared = null;
                
                $sqlPrepared = $pdo->prepare($sql);
                $sqlPrepared->bindValue(":OrderID", $orderid);
                $sqlPrepared->bindValue(":ProductID", $tProduct['ProductID']);
                $sqlPrepared->bindValue(":UnitPrice", $tProduct['UnitPrice']);
                $sqlPrepared->bindValue(":Quantity", $tProduct['Quantity']);
                $sqlPrepared->bindValue(":Comment", $tProduct['Comment']);
                $sqlPrepared->execute();
            }*/
            
            $orderDateArray = date_parse($next['OrderDate']);
            $dueDateArray = date_parse($next['DueDate']);
            
            $_SESSION['OrderSelected']['OrderID'] = $_POST['OrderID'];
            $_SESSION['OrderSelected']['VendorID'] = $_POST['VendorID'];
            $_SESSION['OrderSelected']['RestaurantID'] = $_POST['RestaurantID'];
            $_SESSION['OrderSelected']['OrderDate'] = date('Y-m-d', mktime(0,0,0,$orderDateArray["month"],$orderDateArray["day"],$orderDateArray["year"]));
            $_SESSION['OrderSelected']['DueDate'] = date('Y-m-d', mktime(0,0,0,$dueDateArray["month"],$dueDateArray["day"],$dueDateArray["year"]));
            $_SESSION['ProductsForOrder'] = array();
            
        } catch (Exception $e) {
            htmlout("There was an issue saving the order.");
            htmlout($e->getMessage());
        }
}