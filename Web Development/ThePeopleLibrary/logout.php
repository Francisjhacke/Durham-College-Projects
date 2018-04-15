<!-- DECLARATIONS -->
<?php 
	// Author: Francis Hackenberger - 100%
	$fileName = "logout.php";
	$pageTitle = "Logout"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "2015-11-05";
	$description = "The purpose of this page is for users to logout and clear all sessions
					for that user.";	  
?>

<?php include 'header.php';?>	

<?php 
if (isset($_SESSION['user'])){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		// Unset and destroy the session
		unset($_SESSION);
		session_destroy();
		// Start a new session (in case the user stays on the website and tries to log in again)
		session_start();
		if (!isset($_SESSION['user_message'])){
			$_SESSION['user_message'] = "You have successfully logged out.";
		}
		// Send user to the login page
		header("Location:login.php");
		ob_flush();
	}
}
else{
	header("Location:login.php");
	ob_flush();
}
?>

<!-- insert the page content here -->
<h1>Logout</h1>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<fieldset>
	<div class="center">
		<h4>Thank you for using the People Library!</h4>
		<p>See you soon!</p>
		<input type="submit" value = "Logout"/>
	</div>
	</fieldset>
</form>
			
<?php include 'footer.php';?>

