<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/helpers.inc.php';
	session_start();
	if(isset($_POST['name'])) {

		try {
			// Save the new restaurant data.
			include_once $_SERVER['DOCUMENT_ROOT'] . '/araujo_tc' . '/includes/dbconnect.inc.php';

			$sqlPrepared = null;
			if($_POST['id'] == -1) {
				$sqlPrepared = $pdo->prepare("INSERT INTO tblrestaurant (restaurantname, address1, address2, city, state, zipcode, phoneno, faxno, website, createdby, createdon) values (:rname, :raddone, :raddtwo, :rcity, :rstate, :rzipcode, :rphoneno, :rfaxno, :rurl, :ruser, now())");
			} else {
				htmlout(">".$_POST['id']."<");
				$sqlPrepared = $pdo->prepare("UPDATE tblrestaurant SET " .
					" restaurantname = :rname, " .
					" address1 = :raddone," .
					" address2 = :raddtwo," .
					" city = :rcity," .
					" state = :rstate," .
					" zipcode = :rzipcode," .
					" phoneno = :rphoneno," .
					" faxno = :rfaxno," .
					" website = :rurl, " .
					" createdby = :ruser, " . 
					" createdon = now() " .
					" WHERE restaurantid = :rid");
				$sqlPrepared->bindValue(":rid",$_POST['id']);
			}

			$sqlPrepared->bindValue(":rname",$_POST['name']);
			$sqlPrepared->bindValue(":raddone",$_POST['ad1']);
			$sqlPrepared->bindValue(":raddtwo",$_POST['ad2']);
			$sqlPrepared->bindValue(":rcity",$_POST['city']);
			$sqlPrepared->bindValue(":rstate",$_POST['state']);
			$sqlPrepared->bindValue(":rzipcode",$_POST['zc']);
			$sqlPrepared->bindValue(":rphoneno",$_POST['phno']);
			$sqlPrepared->bindValue(":rfaxno",$_POST['fxno']);
			$sqlPrepared->bindValue(":rurl",$_POST['url']);
			$sqlPrepared->bindValue(":ruser",$_SESSION['user_id']);

			$sqlPrepared->execute();
		} catch (Exception $e) {
			htmlout("There was an issue saving a restaurant.");
		}
	}

