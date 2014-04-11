<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Araujo Inventory Tracker - Orders</title>
<meta name="description" content="">
<meta name="author" content="Tom Chandler">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link href="../../styles/login.css" rel="stylesheet">
<link href="../../styles/nav.css" rel="stylesheet">
<link href="../../styles/styles.css" rel="stylesheet">
<style type="text/css">
    #orderEditor {
        display: table-row;
    }
    #orderEditor label, #orderEditor select, #orderEditor input{
        display: table-cell;
    }
</style>
<script src="/araujo_tc/scripts/orders.js"></script>
</head>
<body>
<header>
  <h1>
    <script type="text/javascript">document.write(document.title)</script>
  </h1>
  <!-- Show Navbar -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/nav.inc.html.php'; ?>
  <!-- Show login -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/login.inc.html.php'; ?>
  <!-- Include drop down queries -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetDropDowns.php'; ?>
  <!-- Get tables -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetTables.php'; ?>
</header>
<div id="main">
  <section id="form">
    <form id="orderEditor">
      <div>
        <label>Vendors</label>
        <select id="VendorID" name="VendorID" >
            <?php populateDropDown('Vendors'); ?>
        </select>
        <label>Restaurants</label>
        <select id="RestaurantID" name="RestaurantID" >
            <?php populateDropDown('Restaurants'); ?>
        </select>
      </div>
      
      <div>
        <label>Order Date</label>
        <input type="date" id="OrderDate" name="OrderDate">
        <label>Due Date</label>
        <input type="date" id="DueDate" name="DueDate" >
      </div>     
      <div>
        <label>Total Price</label>
        <input id="TotalPrice" name="totalPrice" disabled="true" value="<?php getCurrentOrderTotal(); ?>">
      </div>
      <button onClick="oldOrderSave(); return false;">Save Order</button>
      <button onClick="orderClear(); return false;">Clear Order</button>
    </form>
  </section>
  <section id="products"> <br/>
    Product List <br/>
    <form id="productListEditor">
        <table border="1">
            <tr>
                <td>
                    <label>Product</label>
                </td>
                <td>
                    <label>Unit</label>
                </td>
                <td>
                    <label>Quantity</label>
                </td>
                <td>
                    <label>Unit Price</label>
                </td>
                <td>
                    <label>Ext. Price</label>
                </td>                
            </tr>
            <tr>
                <td>
                    <select id="ProductID" name="ProductID" >
                      <?php populateDropDown('Products'); ?>
                    </select>
                </td>
                <td>
                    <select id="UnitID" name="UnitID" >
                        <?php populateDropDown('Units'); ?>
                    </select>
                </td>
                <td>
                    <input id="Quantity" name="quantity" onchange="calculateProductPrice()">
                </td>
                <td>
                    <input id="UnitPrice" name="unitPrice" onchange="calculateProductPrice()">
                </td>
                <td>
                    <input id="ExtPrice" name="extPrice" disabled="true">
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <label>Comment</label>
                    <input id="Comment" name="comment">
                </td>
            </tr>
        </table>       
    </form>
    
    <button onClick="addProduct(); return false;">Add</button>
    
    <?php getCurrentOrderTable(); ?>
  </section>
</div>

</body>
</html>
