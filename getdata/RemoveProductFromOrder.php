<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
    
    session_start();
    
    if(isset($_POST['ProductIndex'])) {
           
        for($i = $_POST['ProductIndex']; $i < count($_SESSION['ProductsForOrder']) - 1; $i++) {
        
            $_SESSION['ProductsForOrder'][$i] = array();
            $_SESSION['ProductsForOrder'][$i]['ProductID'] = $_SESSION['ProductsForOrder'][$i + 1]['ProductID'];
            $_SESSION['ProductsForOrder'][$i]['UnitID'] = $_SESSION['ProductsForOrder'][$i + 1]['UnitID'];
            $_SESSION['ProductsForOrder'][$i]['Quantity'] = $_SESSION['ProductsForOrder'][$i + 1]['Quantity'];
            $_SESSION['ProductsForOrder'][$i]['UnitPrice'] = $_SESSION['ProductsForOrder'][$i + 1]['UnitPrice'];
            $_SESSION['ProductsForOrder'][$i]['ExtPrice'] = $_SESSION['ProductsForOrder'][$i + 1]['ExtPrice'];
            $_SESSION['ProductsForOrder'][$i]['Comment'] = $_SESSION['ProductsForOrder'][$i + 1]['Comment'];
        }
        
        $_SESSION['ProductsForOrder'][count($_SESSION['ProductsForOrder']) - 1] = array();
    }

