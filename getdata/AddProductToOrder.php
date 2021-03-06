<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetValues.php';
    
    session_start();
    
    if(isset($_POST['ProductID'])) {

        if(!isset($_SESSION['ProductsForOrder'])) {
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
        $_SESSION['ProductsForOrder'][$counter]['ProductName'] = getProductName($_POST['ProductID']);
        $_SESSION['ProductsForOrder'][$counter]['UnitName'] = getUnitName($_POST['UnitID']);
    }

