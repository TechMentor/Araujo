<?php
// if magic quotes (a bad way to handle SQL Injection attacks) is on then undo its results.  See pages 121 - 123
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/magicquotes.inc.php';

// check login status
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/login.inc.php';

// display home page
include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/index.html.php';
?>