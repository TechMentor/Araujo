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
<link href="../styles/login.css" rel="stylesheet">
<link href="../styles/nav.css" rel="stylesheet">
<link href="../styles/styles.css" rel="stylesheet">
<style type="text/css">

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

      <label>Restaurants</label>
      <select id="RestaurantID" name="RestaurantID" >
          <?php populateDropDown('Restaurants'); ?>
      </select>
      <br>     
        
      <label>Vendors</label>
      <select id="VendorID" name="VendorID" class="col2">
          <?php populateDropDown('Vendors'); ?>
      </select>
      <br>
      
      <label>Order Date</label>
      <input type="date" id="OrderDate" name="OrderDate" class="col2">
      <br>
      
      <label>Due Date</label>
      <input type="date" id="DueDate" name="DueDate" >
      <br>
      
      <br>
      <button onClick="OrderSave(); return false;">Add Order</button>
      <button onClick="orderClear(); return false;">Clear Order</button>
      <p>Doesn't work, error in SQL because the Create Date was null.</p>
    </form>
  </section>
  <br>
  <section id="orders"> <br/>
    Orders List <br/>
    <?php getTable("Orders", NULL);  ?>
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
