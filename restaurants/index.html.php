<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Araujo Inventory Tracker - Restaurants</title>
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
		min-width: 2.5em;
		display:inline-block;		
	}
	.col3 {
		min-width: 4em;
		display:inline-block;				
	}
	#restaurantName, #addressOne, #addressTwo {
		min-width: 45em;
		display:inline-block;
	}
</style>
<script src="../scripts/restaurant.js"></script>
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
  <!-- Get tables -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetTables.php'; ?>
</header>
<div id="main">
  <section id="form">
    <form id="restaurantEditor" onsubmit="return false;">
      <label class="col1">Restaurant Name </label>
      <input id="restaurantName" name="restaurantName" >
      <br>
      <label class="col1">Address 1</label>
      <input id="addressOne" name="addressOne" >
      <br>
      <label class="col1">Address 2</label>
      <input id="addressTwo" name="addressTwo" >
      <br>
      <label class="col1">City</label>
      <input id="city" name="city" >
      <label class="col2">State</label>
      <input name="state" id="state" maxlength="2" >
      <label class="col3">Zip Code</label>
      <input id="zipCode" name="zipCode" >
      <br>
      <label class="col1">Phone #</label>
      <input id="phoneNo" name="phoneNo" >
      <label class="col2">Fax #</label>
      <input id="faxNo" name="faxNo" >
      <label class="col3">Website</label>
      <input id="website" name="website" >
      <br>
      <br>
      <br />
      <button onClick="restaurantSave(restaurantEditing); return false;">Save</button>
      <button onClick="restaurantClear()">Clear</button>
      <button id="editInvLevels" onClick="goTo('Main.ctl.php?link=InventoryLevels.php')" disabled="true">Edit Inventory Levels</button>
    </form>
  </section>
  <section id="list"> <br/>
    <br/>
    <?php getTable("Restaurants"); ?>
  </section>
</div>
</body>
</html>
