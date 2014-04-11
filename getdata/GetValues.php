<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

function getProductName($productID){
    $strSQL = "SELECT ProductName FROM tblproduct WHERE ProductID = :productID";
    $pdo = getDBConnection();
    $sqlPrepared = $pdo->prepare($strSQL);
    $sqlPrepared->bindValue(":productID", $productID);
    $sqlPrepared->execute();
    $next = $sqlPrepared->fetch();
    return $next['ProductName'];
}

function getUnitName($unitID){
    $strSQL = "SELECT Unit FROM tblunit WHERE UnitID = :unitID";
    $pdo = getDBConnection();
    $sqlPrepared = $pdo->prepare($strSQL);
    $sqlPrepared->bindValue(":unitID", $unitID);
    $sqlPrepared->execute();
    $next = $sqlPrepared->fetch();
    return $next['Unit'];
}
?>