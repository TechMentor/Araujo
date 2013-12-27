<?php
// if magic quotes (a bad way to handle SQL Injection attacks) is on then undo its results.  See pages 121 - 123
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/magicquotes.inc.php';

// include helper functions
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';

// check login status
include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/login.inc.php';

// if no user_name, no user_type, or user_type is invalid then show login failure
if(!isset($_SESSION['user_name']) && !isset($_SESSION['user_type']) || $_SESSION['user_type'] <= 0) {
	//include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/login_failure.inc.html.php';
	
	$error = 'Sorry, you must be logged in to see the list of vendors.';
	include $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/error.html.php';
	exit();
} 

// login succeeded so get and show restaurants
else {
	include 'index.html.php';
}
?>