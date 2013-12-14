<div id="login">
	<form method="post" action="index.php" id="loginForm">
	<?php if(isset($_SESSION['user_name'])) { ?>
		<label name="welcomeMsg" id="welcomeMsg"> <?php htmlout("Welcome, " . $_SESSION['user_name']); ?> </label>
		<input name="submit" type="submit" value="Logout">	
	<?php } else { ?>
			<label> Username: </label>
			<input type="text" name="uname" id="uname"/>
			<label> Password: </label>
			<input type="password" name="pword" id="pword"/>
			<input name="submit" type="submit" value="Login">				
	<?php } ?>

	</form>
</div>
