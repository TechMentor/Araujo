<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
        include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';
        
	session_start();
	if(isset($_POST['name'])) {

		try {
			// Save the new vendor data.
                        $pdo = getDBConnection();
                        $sql = null;
                        $sqlPrepared = null;
			if($_POST['id'] == -1) {
				$sql = "INSERT INTO tblvendor (vendorname, address1, address2, city, state, zipcode, createdby, createdon) values (:rname, :raddone, :raddtwo, :rcity, :rstate, :rzipcode, :ruser, now())";
                                $sqlPrepared = $pdo->prepare($sql);
			} else {
				htmlout(">".$_POST['id']."<");
				$sql = "UPDATE tblvendor SET " .
					" vendorname = :rname, " .
					" address1 = :raddone," .
					" address2 = :raddtwo," .
					" city = :rcity," .
					" state = :rstate," .
					" zipcode = :rzipcode," .
					" createdby = :ruser, " . 
					" createdon = now() " .
					" WHERE vendorid = :rid";
                                $sqlPrepared = $pdo->prepare($sql);
				$sqlPrepared->bindValue(":rid",$_POST['id']);
			}                        
                                               
			$sqlPrepared->bindValue(":rname",$_POST['name']);
			$sqlPrepared->bindValue(":raddone",$_POST['ad1']);
			$sqlPrepared->bindValue(":raddtwo",$_POST['ad2']);
			$sqlPrepared->bindValue(":rcity",$_POST['city']);
			$sqlPrepared->bindValue(":rstate",$_POST['state']);
			$sqlPrepared->bindValue(":rzipcode",$_POST['zc']);
			$sqlPrepared->bindValue(":ruser",$_SESSION['user_id']);


			$sqlPrepared->execute();
                        
//                        for debugging purposes output the user id to the log file.
                        outputToText('Session\'s user_id is ' . $_SESSION['user_id']);
                        
//                        for debugging purposes output the prepared statement to the log file.
//                        This output failed.
//                        outputToText('Value of sqlPrepared is:');
//                        outputToText($sqlPrepared->debugDumpParams());  See http://www.php.net/manual/en/pdostatement.debugdumpparams.php
//                        outputToText('End of sqlPrepared statement.');
		} catch (Exception $e) {
			htmlout("There was an issue saving a vendor.");
		}
	}

