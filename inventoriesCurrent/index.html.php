<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Araujo Inventory Tracker - Current Inventory</title>
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
	}
	#productName {
		min-width: 60em;
		display:inline-block;
	}
</style>
<script src="../scripts/currentInventory.js"></script>
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
</header>
<div id="main">
  <section id="form">
    <form id="currentInventoryProcessor">
      <label class="col1">Report Date </label>
      <input id="reportDate" name="reportDate" >
      <label class="col2">Restaurant</label>
      <select id="restaurantID" name="restaurantID" ></select>
      <button onClick="currentInventoryProcess(currentInventoryProcessing)">View</button>
      <button onClick="currentInventoryClear()">Clear</button>
    </form>
  </section>
  <section id="list"> <br/>
    <br/>
    <table border="1">
      <tr>
        <td>Product</td>
        <td>Restaurant</td>
        <td>Target Level</td>
        <td>Last Inventory Date</td>
        <td>Last Inventory Qty</td>
        <td>Recent Receipts</td>
        <td>Current Level</td>
        <td>On Order</td>
        <td>Created By</td>
        <td>Created On</td>
      </tr>
      <?php for($i = 0; $i < count($currentInventory); $i++) { ?>
      <tr>
        <td><?php htmlout( $currentInventory[$i]['ProductName']); ?></td>
        <td><?php htmlout( $currentInventory[$i]['RestaurantID']); ?></td>
		<td><?php htmlout( $currentInventory[$i]['TargetLevel']); ?></td>
		<td><?php htmlout( $currentInventory[$i]['LastInventoryDate']); ?></td>
		<td><?php htmlout( $currentInventory[$i]['LastInventoryQty']); ?></td>
		<td><?php htmlout( $currentInventory[$i]['RecentReceipts']); ?></td>
		<td><?php htmlout( $currentInventory[$i]['CurrentLevel']); ?></td>
    	<td><?php htmlout( $currentInventory[$i]['OnOrder']); ?></td>
    	<td><?php htmlout( $currentInventory[$i]['CreatedBy']); ?></td>
    	<td><?php htmlout( $currentInventory[$i]['CreatedOn']); ?></td>
      </tr>
      <?php } ?>
    </table>
  </section>
</div>

</body>
</html>
