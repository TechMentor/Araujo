<?php
        include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
	// Enumerated values
	define("PROGRAMMER", 1);
	define("ADMIN", 4);
	
	// Try to get the "link" variable in the query string.
	if(isset($_GET["link"])) {
		$body_page = $_GET["link"];
	} else {
		$body_page = "index.php";
	}
	
	// PHP code to start the session [required]
	session_start();

	// if user clicked Logout, then end session
	if(isset($_POST['submit']) && $_POST['submit'] == "Logout") {
		sessionEnd();
	}
	
	// if user supplied a username and password then....
	if(isset($_POST['uname']) && isset($_POST['pword'])) {
		$uname = $_POST['uname'];
		$pword = $_POST['pword'];
		$loginUser = "";
		$loginUserType = 0;

		// Simple database check for username
		try {
                        $pdo = getDBConnection();
			$sqlPrepared = $pdo->prepare("SELECT * FROM tbluser WHERE loginname =:username");
			$sqlPrepared->bindValue(":username",$uname);
			$sqlPrepared->execute();

			// Get the next row from the database query.
			if($next = $sqlPrepared->fetch()) {
				$loginUserType = (int)$next['UserType'];
				$_SESSION['user_name'] = $uname;
				$_SESSION['user_type'] = $loginUserType;
				$_SESSION['user_id'] = $next['UserID'];
			} else {
				sessionEnd();
			}
		} catch (PDOException $e) {
			sessionEnd();
		}

		unset($uname);
		unset($pword);
	}

	function sessionEnd() {
		$_SESSION = array();
		session_destroy();
	}

	function userIsType($type) {
		if(!isset($_SESSION['user_type'])) { return FALSE; }
		switch($type) {
			case "ADM": 
                            return ($_SESSION['user_type'] == constant("PROGRAMMER") || $_SESSION['user_type'] == constant("ADMIN")); 
			case "USR": 
                            return ($_SESSION['user_type'] > 0);
		}
		return FALSE;
	}
?>