<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Araujo Inventory Tracker - error</title>
<meta name="description" content="">
<meta name="author" content="Tom Chandler">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
<link rel="shortcut icon" href="/favicon.ico">
<!--<link rel="apple-touch-icon" href="/apple-touch-icon.png">-->

<!-- Styles using folder up one level. -->
<link href="../styles/login.css" rel="stylesheet">
<link href="../styles/nav.css" rel="stylesheet">
<link href="../styles/styles.css" rel="stylesheet">

<!-- Styles using folder up two levels. -->
<link href="../../styles/login.css" rel="stylesheet">
<link href="../../styles/nav.css" rel="stylesheet">
<link href="../../styles/styles.css" rel="stylesheet">


<style type="text/css"></style>
</head>
<body>
<header>
  <h1>
    <script type="text/javascript">document.write(document.title)</script>
  </h1>
  <!-- Show Navbar -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/nav.inc.html.php'; ?>
  <!-- Show login -->
  <?php  include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/login.inc.html.php'; ?>
</header>
<div id="main">
  <h1><?php htmlout($error); ?></h1>
</div>
</body>
</html>
