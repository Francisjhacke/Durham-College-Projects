	<?php $fileName="login.php" ?>
	<?php $date="September 2015" ?>
	<?php $description="The purpose of this page is to allow users to login to
						our website and after logging, gain access to the other
						features of the website. " ?>
	<?php $title="People Library Login" ?>
	<?php $banner="People Library Login" ?>
	<?php include("header.php"); ?>
	<h2> <?php echo $banner ?> </h2>

<?php
$login = "";
$password = "";
$output = "";

if (isset($_SESSION['user_message'])){
		echo $_SESSION['user_message']."\n";
}
unset($_SESSION['user_message']);
	
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$login = trim($_POST['login']);
		$password = trim($_POST['pass']);
		$hashed_md5 = md5(SALT_FOR_HASH . $password);
		$date = date("Y-m-d");
	
		$conn = db_connect();

		$myLogin = array($login, $hashed_md5);
		$result = pg_execute($conn, "query_user_login_info", $myLogin);
		$records = pg_num_rows($result);
		if ($records) 
		{
			$user = pg_fetch_assoc($result);
			$user_last_access = array($date, $login);
			$result = pg_execute($conn, "update_last_access", $user_last_access);
			$_SESSION['last_access'] = $date;
			
			setcookie("user_id", $login, time() + EXPIRE_PERIOD); // Cookie exists for 30 days

			$_SESSION['user'] = $user;
			// Redirect the user depending on their user_type status
			if ($user['user_type'] == DISABLED_CLIENT){
				$_SESSION['user_message'] = "Your account has been disabled. Please take note of our Acceptable Use Policy".
				header("Location:aup.php");
				ob_flush();
			}
			elseif ($user['user_type'] == INCOMPLETE_CLIENT){
				header("Location:create_profile.php");
				ob_flush();
			}elseif ($user['user_type'] == ADMIN){
				header("Location:admin.php");
				ob_flush();
			}elseif ($user['user_type'] == CLIENT){
				$myUserID = array($login);
				$result = pg_execute($conn, "query_profile_info", $myUserID);
				$profile = pg_fetch_assoc($result);
				$_SESSION['profile'] =  $profile;
				header("Location:dashboard.php");
				ob_flush();
			}
			
		}
		else
		{
			$login = "";
			$password = "";
			echo "<b>\nLogin/Password not found</b>";
		}
	}
	
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<fieldset>
		<label for="login">Username:</label>
		<input type="text" id="login" name="login" value="<?php if(isset($_COOKIE['user_id'])){echo $_COOKIE['user_id'];} else {echo $login;} ?>" size="20"/>
		
		<label for="pass">Password:</label>
		<input type="password" id="pass" name="pass" value="" size="20"/>
		<input type="submit" value = "Log In"/>
		
		<input type="reset" value = "Clear"/>
		<br/>
		<br/>
		<p><em>(Login may take a few moments)</em></p>
		<p><a href="user_password_request.php">Forgot your password?</a></p>
	</fieldset>
</form>
<hr/>

<?php include("footer.php"); ?>