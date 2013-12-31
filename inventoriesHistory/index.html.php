<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Araujo Inventory Tracker - Add to / View Inventory History</title>
<meta name="description" content="">
<meta name="author" content="Tom Chandler">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<link href="../styles/login.css" rel="stylesheet">
<link href="../styles/nav.css" rel="stylesheet">
<link href="../styles/styles.css" rel="stylesheet">
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
<script src="../scripts/helpers.js"></script>
<script src="../scripts/inventory.js"></script>
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
    <form id="inventoryHistoryProcessor">
      <label class="col1">Inventory Date </label>
      <input type="date" id="inventoryDate" name="inventoryDate" >
      
      <label>Restaurant</label>
      <select id="restaurantID" name="restaurantID" >
          <?php populateDropDown('Restaurants'); ?>
      </select>
      
      <label>Product</label>
      <select id="productID" name="productID" >
          <?php populateDropDown('Products'); ?>
      </select>
      
      <label>Qty</label>
      <input id="Qty" name="Qty" >
      
      <!-- <button onClick="currentInventoryAdd(inventoryHistoryAdd)">Add</button> -->
      
      <!-- returning false prohibits the form from being submitted. (See http://stackoverflow.com/questions/7577275/jquery-ajax-requests-are-getting-cancelled-without-being-sent) -->
      
      <button onClick="currentInventoryAdd(); return false;">Add</button>
    </form>
  </section>
  <section id="list"> <br/>
    <br/>

    <form id="inventoryHistoryFilter" onsubmit="return false;">
      <label class="col1">Inventory Date </label>
      <input type="date" id="filter_inventoryDate" name="inventoryDate" >
      
      <label>Restaurant</label>
      <select id="filter_restaurantID" name="restaurantID" >
          <?php populateDropDown('Restaurants'); ?>
      </select>
      
      <label>Product</label>
      <select id="filter_productID" name="productID" >
          <?php populateDropDown('Products'); ?>
      </select>
      
      <label>Qty</label>
      <input id="filter_Qty" name="Qty" >      
      <button onClick="currentInventoryFilter(); return false">Filter</button> 
      <button onClick="inventoryFilterClear(); return false;">Clear</button>
    </form>
    <br/>
    
    <?php getTable("InventoryHistory"); ?>
  </section>
</div>

</body>
</html>
