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
		min-width: 5em;
		display:inline-block;
	}
	.col2 {
		min-width: 12em;
		display:inline-block;
	}	
	.col3 {
		min-width: 6em;
		display:inline-block;		                
	}	
        #productName {
		min-width: 20em;
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
      <select id="OrderID" name="OrderID" onchange="orderEdit();">
          <?php populateDropDown('OrderIDList', 0); ?>
      </select>
      <label class="col1">Vendors</label>
      <select id="VendorID" name="VendorID" class="col2">
          <?php populateDropDown('Vendors'); ?>
      </select>
      
      <label class="col3">Restaurants</label>
      <select id="RestaurantID" name="RestaurantID" >
          <?php populateDropDown('Restaurants'); ?>
      </select>
      <br>
      
      <label class="col1">Order Date</label>
      <input type="date" id="OrderDate" name="OrderDate" class="col2">
      
      <label class="col3">Due Date</label>
      <input type="date" id="DueDate" name="DueDate" >
      <br>
      
      <label class="col1">Total Price</label>
      <input id="TotalPrice" name="totalPrice" disabled="true" value="<?php getCurrentOrderTotal(); ?>">
            
      <br>
      <br>
      <button onClick="orderUpdate(); return false;">Update Order</button>
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
                    <label class="col1">Comment</label>
                    <input id="Comment" name="comment">
                </td>
            </tr>
        </table>       
    </form>
    
    <button onClick="saveProduct(); return false;">Add</button>
    
    <?php getCurrentOrderTable(); ?>
  </section>
</div>

</body>
<script type="text/javascript">
    document.getElementById("OrderID").value = <?php echo $_SESSION['OrderSelected']['OrderID'] ?>;
    document.getElementById("VendorID").value = <?php echo $_SESSION['OrderSelected']['VendorID'] ?>;
    document.getElementById("RestaurantID").value = <?php echo $_SESSION['OrderSelected']['RestaurantID'] ?>;
    document.getElementById("OrderDate").value = <?php echo '"' . $_SESSION['OrderSelected']['OrderDate'] . '"' ?>;
    document.getElementById("DueDate").value = <?php echo '"' . $_SESSION['OrderSelected']['DueDate'] . '"'; ?>;
</script>
</html>
