<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Araujo Inventory Tracker - Products</title>
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
<script src="../scripts/products.js"></script>
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
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/getdata/GetCategories.php'; ?>
</header>
<div id="main">
  <section id="form">
    <form id="productEditor">
      <label class="col1">Product Name </label>
      <input id="productName" name="productName" >
      <br>
      
      <label class="col1">Category</label>
      <select id="categoryId" name="categoryId" >
          <?php 
            foreach ($Categories as $row){
          ?>
            <option value="<?php echo $row['CategoryID'] ?>"><?php echo $row['CategoryName'] ?></option>
          <?php
            }
          ?>
      </select>
      
      <label class="col2">Unit</label>
      <select id="unitId" name="unitId" ></select>
      <br>
      
      <label class="col1">Responsible Party</label>
      <select id="responsiblePartyId" name="responsiblePartyId" ></select>

      <label class="col2">Preferred Vendor</label>
      <select id="preferredVendorId" name="preferredVendorId" ></select>
      <br>
      
      <label class="col1">Note</label>
      <input id="note" name="note" >
      <br>
            
      <br>
      <br>
      <button onClick="productSave(productEditing)">Save</button>
      <button onClick="productClear()">Clear</button>
    </form>
  </section>
  <section id="list"> <br/>
    <br/>
    <table border="1">
      <tr>
        <td>Product</td>
        <td>Category</td>
        <td>Unit</td>
        <td>Responsible Party</td>
        <td>Preferred Vendor</td>
        <td>Note</td>
        <td>Edit</td>
      </tr>
      <?php for($i = 0; $i < count($products); $i++) { ?>
      <tr>
        <td><?php htmlout($products[$i]['ProductName']); ?></td>
        <td><?php htmlout($products[$i]['CategoryID']); ?></td>
		<td><?php htmlout($products[$i]['UnitID']); ?></td>
		<td><?php htmlout($products[$i]['ResponsiblePartyID']); ?></td>
		<td><?php htmlout($products[$i]['PreferredVendorID']); ?></td>
		<td><?php htmlout($products[$i]['Note']); ?></td>
        <td><button name="<?php htmlout('eButton' . $i); ?>" onClick="productEdit(<?php htmlout($products[$i]['ID']); ?>)">Edit</button></td>
      </tr>
      <?php } ?>
    </table>
  </section>
</div>

</body>
</html>
