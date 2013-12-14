<?php
    // Log into the database.
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/my.php';

    // Create an SQL statement
    $CategoryQuery = "SELECT CategoryID, CategoryName FROM tblcategory";
    
    // Get the results of the SQL and store it in a cursor (result/record set).
    $Categories = $pdo->query($CategoryQuery);
?>
