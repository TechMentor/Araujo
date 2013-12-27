<?php

function getDBConnection() {
    // Returns a PDO (PHP Data Object) that is connected to the MySQL database.
    
    $pdo = NULL;
    
    try
    {
      // Create a PDO object which stores the connection to the MySQL database.
      $pdo = new PDO('mysql:host=localhost;dbname=techment_araujo', 'techment_zach', 'abcwxy');

      // If the PDO has trouble connecting then throw an exception so we can figure out what is wrong. See N2N p103.
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // configure character encoding to UTF-8 to maximize the range of characters users have at their disposal when filling in forms. See N2N p103.
      $pdo->exec('SET NAMES "utf8"');
    }
    catch (PDOException $e)
    {
      $error = 'Sorry, unable to connect to the database server.';
      include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/error.html.php';
      exit();
    }
    
    return $pdo;
}