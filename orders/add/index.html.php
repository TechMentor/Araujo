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
	.col1 {
		min-width: 7em;
		display:inline-block;
	}
	.col2 {
		min-width: 7em;
		display:inline-block;		
	}	
	#productName {
		min-width: 60em;
		display:inline-block;
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
      <label class="col1">Vendors</label>
      <select id="PreferredVendorID" name="preferredVendorId" >
          <?php populateDropDown('Vendors'); ?>
      </select>
      
      <label class="col1">Restaurants</label>
      <select id="restaurantID" name="restaurantId" >
          <?php populateDropDown('Restaurants'); ?>
      </select>
      <br>
      
      <label class="col2">Order Date</label>
      <input type="date" id="orderDate" name="orderDate" >
      
      <label class="col1">Due Date</label>
      <input type="date" id="dueDate" name="dueDate" >
      <br>
      
      <label class="col2">Total Price</label>
      <input id="TotalPrice" name="totalPrice" disabled="true" value="<?php getCurrentOrderTotal(); ?>">
            
      <br>
      <br>
      <button onClick="orderSave(); return false;">Save Order</button>
      <button onClick="orderClear(); return false;">Clear Order</button>
    </form>
  </section>
  <section id="products"> <br/>
    Product List <br/>
    <form id="productListEditor">
        <label class="col1">Product</label>
        <select id="ProductID" name="ProductID" >
          <?php populateDropDown('Products'); ?>
        </select>
        
        <label class="col1">Unit</label>
        <select id="UnitID" name="UnitID" >
          <?php populateDropDown('Units'); ?>
        </select>
        
        <label class="col1">Quantity</label>
        <input id="Quantity" name="quantity" onchange="calculateProductPrice()">
        
        <label class="col1">Unit Price</label>
        <input id="UnitPrice" name="unitPrice" onchange="calculateProductPrice()">
        
        <label class="col1">Ext. Price</label>
        <input id="ExtPrice" name="extPrice" disabled="true">
        
        <label class="col1">Comment</label>
        <input id="Comment" name="comment">
        
        <button onClick="addProduct(); return false;">Add</button>
    </form>
    
    <?php getCurrentOrderTable(); ?>
  </section>
</div>

</body>
</html>
