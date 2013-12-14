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
<style type="text/css"></style>
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
</header>
<div id="main">
  <section id="form">
    <form id="restaurantEditor">
    
      <table>
        <tr>
          <td> Restaurant Name </td>
          <td> Address 1 </td>
          <td> Address 2 </td>
          <td> City </td>
        </tr>
        <tr>
          <td><input id="restaurantName" name="restaurantName" >
            </input></td>
          <td><input id="addressOne" name="addressOne" >
            </input></td>
          <td><input id="addressTwo" name="addressTwo" >
            </input></td>
          <td><input id="city" name="city" >
            </input></td>
        </tr>
        <tr>
          <td> State </td>
          <td> Zip Code </td>
          <td> Phone # </td>
          <td> Fax # </td>
        </tr>
        <tr>
          <td><input id="state" name="state" >
            </input></td>
          <td><input id="zipCode" name="zipCode" >
            </input></td>
          <td><input id="phoneNo" name="phoneNo" >
            </input></td>
          <td><input id="faxNo" name="faxNo" >
            </input></td>
        </tr>
        <tr>
          <td> Website </td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><input id="website" name="website" ></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
      <table>
        <tr>
          <td><button onClick="restaurantSave(restaurantEditing)">Save</button></td>
          <td><button onClick="restaurantClear()">Clear</button></td>
        </tr>
        <tr>
          <td><button id="editInvLevels" onClick="goTo('Main.ctl.php?link=InventoryLevels.php')" disabled="true">Edit Inventory Levels</button></td>
        </tr>
      </table>
    </form>
  </section>
  <section id="list"> <br/>
    <br/>
    <table border="1">
      <tr>
        <td>Restaurant</td>
        <td>Address</td>
        <td>Phone #</td>
        <td>Fax #</td>
        <td>Website</td>
        <td>Edit</td>
      </tr>
      <?php for($i = 0; $i < count($restaurants); $i++) { ?>
      <tr>
        <td><?php echo $restaurants[$i]['Name']; ?></td>
        <td><?php echo $restaurants[$i]['AddressOne'] . " " . $restaurants[$i]['AddressTwo'] . " " . $restaurants[$i]['City'] . ", " . $restaurants[$i]['State'] . " " . $restaurants[$i]['ZipCode']; ?></td>
        <td><?php echo $restaurants[$i]['PhoneNo']; ?></td>
        <td><?php echo $restaurants[$i]['FaxNo']; ?></td>
        <td><?php echo $restaurants[$i]['Website']; ?></td>
        <td><button name="<?php echo 'eButton' . $i; ?>" onClick="restaurantEdit(<?php echo $restaurants[$i]['ID']; ?>)">Edit</button></td>
      </tr>
      <?php } ?>
    </table>
  </section>
</div>
</body>
</html>
