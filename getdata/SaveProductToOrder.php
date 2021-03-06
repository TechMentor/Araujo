<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

session_start();

if (isset($_POST['OrderID'])) {

    $pdo = getDBConnection();

    if (!isset($_SESSION['ProductsForOrder'])) {
        $_SESSION['ProductsForOrder'] = array();
    }

    $counter = count($_SESSION['ProductsForOrder']);
    $_SESSION['ProductsForOrder'][$counter] = array();
    $_SESSION['ProductsForOrder'][$counter]['ProductID'] = $_POST['ProductID'];
    $_SESSION['ProductsForOrder'][$counter]['UnitID'] = $_POST['UnitID'];
    $_SESSION['ProductsForOrder'][$counter]['Quantity'] = $_POST['Quantity'];
    $_SESSION['ProductsForOrder'][$counter]['UnitPrice'] = $_POST['UnitPrice'];
    $_SESSION['ProductsForOrder'][$counter]['ExtPrice'] = $_POST['ExtPrice'];
    $_SESSION['ProductsForOrder'][$counter]['Comment'] = $_POST['Comment'];

    $sql = "INSERT INTO tblorderproduct (OrderID, ProductID, UnitPrice, Quantity, Comment) " .
            "VALUES (:OrderID, :ProductID, :UnitPrice, :Quantity, :Comment)";

    $tProduct = $_SESSION['ProductsForOrder'][$counter];
    $sqlPrepared = null;

    $sqlPrepared = $pdo->prepare($sql);
    $sqlPrepared->bindValue(":OrderID", $_POST['OrderID']);
    $sqlPrepared->bindValue(":ProductID", $tProduct['ProductID']);
    $sqlPrepared->bindValue(":UnitPrice", $tProduct['UnitPrice']);
    $sqlPrepared->bindValue(":Quantity", $tProduct['Quantity']);
    $sqlPrepared->bindValue(":Comment", $tProduct['Comment']);
    $sqlPrepared->execute();
}

