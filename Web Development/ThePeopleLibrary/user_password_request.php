<!-- DECLARATIONS -->
<?php 
// Author: Francis Hackenberger - 100%

$fileName="user_password_request.php"; 
$date="November 2015"; 
$description="The purpose of this page is for a user to request a new password. They will been
			  required to enter their username and email address and will then be sent an email
			  with an 8-character/digit password if their username and email matched."; 
$title="Password request"; 
$banner="People Library Password Request";
include("header.php");
?>
<?php 
$user_id = isset($_COOKIE['user_id'])?$_COOKIE['user_id']:"";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$user_id = trim($_POST['user_id']);
	$email_address = trim($_POST['email_address']);
	
	$output = "";			// The output variable to display any errors
	$valid = true;			// The input was valid
	$conn = db_connect();	// Connect to the database
	
	
	// EMAIL ADDRESS VALIDATION
	if ($email_address == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter an email address.");
	}
	else
	{
		if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) 
		{
			$valid = false;
			$output .= nl2br("\nYou didn't enter a valid email address.");
		}
		else{
			// Validate that the user id entered matches the email address
			$passRequestInfo = array($user_id, $email_address);
			$result = pg_execute($conn, "password_request", $passRequestInfo);
			$records = pg_num_rows($result);
			
			if ($records == 0) {
				$valid = false;
				$output .= nl2br("\nThe user name and email entered did not match!");
			}
			
			if ($valid)
			{		
				// Generate a random 8-character/digit password
				$random_password = generateRandomString();
				// Update the users password to the random 8-character/digit password
				$hashed_md5 = md5(SALT_FOR_HASH . $random_password);
				$update_pass = array($hashed_md5, $user_id);
				$records = pg_execute($conn, "update_password", $update_pass);
				if ($records)
				{
					// Email the new password to the users email
					$to = $email_address;
					$subject = "Password Request Successful";
					$signature = '<br/><br/> <h1><a href="http://opentech2.durhamcollege.org/wede3201/group20/index.php">The People Library</a></h1><br/>';
					$signature .= '<h2>Don\'t judge a book by its cover</h2>';
					$message .= "Hello " . $user_id . " we've updated your password.\n Please use the following code next time you log in: " . $random_password;
					$message .= '<br/> Remember to change your password the next time you log in by going to your <a href="http://opentech2.durhamcollege.org/wede3201/group20/index.php">dashboard</a> and clicking the change your password link.';
					$message .= $signature;
					$headers = 'From: webmaster@thepeoplelibrary.com' . "\r\n" . 'Cc: someoneelse@thepeoplelibrary.com\r\n Bcc: hidden@gmail.com'.'Reply-To: webmaster@thepeoplelibrary.com'."\r\n".'X-Mailer: PHP/' . phpversion();
					mail($to,$subject,$message,$headers);
					// Redirect to the login page and state that their new password was updated and sent to their email
					$_SESSION['user_message'] = "An email has been sent with your new password! Use that to log in next time.";
					header("Location:login.php");
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
}
?>
<h2> <?php echo $banner ?> </h2>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<fieldset>	
		<label for="user_id">Username: </label>
		<input type="text" id="user_id" name="user_id" size="20"/>
		
		<label for="email_address">Email Address: </label>
		<input type="text" id="email_address" name="email_address" size="20"/>
		
		<input type="submit" value= "Reset password"/>
		<input type="reset" value = "Clear"/>
		<br/>
		<br/>
	</fieldset>
</form>
<hr/>


<?php include 'footer.php';?>   