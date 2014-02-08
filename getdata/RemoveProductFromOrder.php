<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
    
    session_start();
    
    if(isset($_POST['ProductIndex'])) {

        $_SESSION['TemporaryPFO'] = array();
        
        $ctr = 0;
        
        for($i = 0; $i <= count($_SESSION['ProductsForOrder']) - 1; $i++) {
            
            if($i == $_POST['ProductIndex']) { continue; }
            
            $_SESSION['TemporaryPFO'][$ctr] = array();
            $_SESSION['TemporaryPFO'][$ctr]['ProductID'] = $_SESSION['ProductsForOrder'][$i]['ProductID'];
            $_SESSION['TemporaryPFO'][$ctr]['UnitID'] = $_SESSION['ProductsForOrder'][$i]['UnitID'];
            $_SESSION['TemporaryPFO'][$ctr]['Quantity'] = $_SESSION['ProductsForOrder'][$i]['Quantity'];
            $_SESSION['TemporaryPFO'][$ctr]['UnitPrice'] = $_SESSION['ProductsForOrder'][$i]['UnitPrice'];
            $_SESSION['TemporaryPFO'][$ctr]['ExtPrice'] = $_SESSION['ProductsForOrder'][$i]['ExtPrice'];
            $_SESSION['TemporaryPFO'][$ctr]['Comment'] = $_SESSION['ProductsForOrder'][$i]['Comment'];

            $ctr++;
            
        }
        
        $_SESSION['ProductsForOrder'] = $_SESSION['TemporaryPFO'];
    }

