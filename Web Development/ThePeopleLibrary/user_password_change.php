<!-- DECLARATIONS -->
<?php 
// Author: Francis Hackenberger - 100%

$fileName="user_password_change.php"; 
$date="November 2015"; 
$description="The purpose of this page is for a user to change their password for their account.
					They will be required to enter their current password as well as their new password and then
					confirm the entry."; 
$title="Change password"; 
$banner="People Library Change Password";
include("header.php");
?>
<?php 
if (!isset($_SESSION['user'])) {
	$_SESSION['user_message'] = "You must login before changing your password!";
	header("Location:login.php");
	ob_flush();
}
elseif (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == DISABLED_CLIENT) {
	header("disabled_user.php");
	ob_flush();
}
else{	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$login = $_SESSION['user']['user_id'];	// Store the session user id into the login variable
			
		$current_password = trim($_POST['pass']);					// The current password
		$hashed_md5 = md5(SALT_FOR_HASH . $current_password);		// Hash the current password (in order to compare it to the one in the database)

		$new_password = trim($_POST['new_pass']);					// The new password
		$confirm_new_password = trim($_POST['confirm_new_pass']);	// Confirm the new password
		
		$output = "";			// The output variable to display any errors
		$valid = true;			// The input was valid
		
		$conn = db_connect();	// Connect to the database
		
		// Validate the users current password
		$myLogin = array($login, $hashed_md5);
		$result = pg_execute($conn, "query_user_login_info", $myLogin);
		$records = pg_num_rows($result);
		
		if ($records == 0) {
			$valid = false;
			$output .= nl2br("\nInvalid current password entered");
		}
		
		// Validate the users new password
		if ($new_password == "")
		{
			$valid = false;
			$output .= nl2br("\nYou must enter a password.");
		}
		else
		{
			if (strcmp($new_password, $confirm_new_password) !== 0)
			{
				$valid = false;
				$output .= "The passwords entered did not match </br>";
				$password = "";
				$confirm_password = "";
			}
			
			elseif (strlen($new_password) < MINIMUM_PASSWORD_LENGTH)
			{
				$valid = false;
				$output .= nl2br("\nPassword must be longer than " . MINIMUM_PASSWORD_LENGTH . " characters, symbols, or numbers.");
			} 
			else 
			{
				$new_hashed_md5 = md5(SALT_FOR_HASH . $new_password);		// The new password hashed
			}
		}
		
		if ($valid)
		{		
			$update_pass = array($new_hashed_md5, $login);
			$records = pg_execute($conn, "update_password", $update_pass);
			if ($records)
			{
				$_SESSION['user_message'] = "Password successfully changed!";
				header("Location:dashboard.php");
				ob_flush();
			}
			// Error inserting records
			else
			{
				$output .= nl2br("\nAn sql error occurred!");
			}
		}
		// An entry or more has not passed validation
		else
		{
			$output .= nl2br("\nOopz! Please try again.");	
			echo $output;
		}
	}
}
?>
<h2> <?php echo $banner ?> </h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<fieldset>
		<h2><?php echo $_SESSION['user']['user_id'];?></h2>
		
		<label for="pass">Current Password:</label>
		<input type="password" id="pass" name="pass" size="20"/>
		
		<label for="new_pass">New Password:</label>
		<input type="password" id="new_pass" name="new_pass" size="20"/>
		
		<label for="confirm_new_pass">Confirm New Password:</label>
		<input type="password" id="confirm_new_pass" name="confirm_new_pass" size="20"/>
		
		<p><a href='dashboard.php'>Cancel and return</a></p>
		<input type="submit" value = "Change Password"/>
		
		<input type="reset" value = "Clear"/>
		<br/>
		<br/>
	</fieldset>
</form>
<hr/>


<?php include 'footer.php';?>