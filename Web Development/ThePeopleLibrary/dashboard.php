<!-- DECLARATIONS -->
<?php 
	// Author: Francis Hackenberger - 100%
	$fileName = "dashboard.php";
	$pageTitle = "Dashboard"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "2015-09-28";
	$description = "The purpose of this page is to be the logged in users dashboard where they can view
					different information about their account and or the website in general. ";	  
?>

<?php include 'header.php';?>	

<?php 
if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == CLIENT){
	
	if (isset($_SESSION['user_message'])){
		echo $_SESSION['user_message'];
		unset($_SESSION['user_message']);	// Clear the user message
	}
	
	$user_id = $_SESSION['user']['user_id'];
}
elseif ($_SESSION['user']['user_type'] == INCOMPLETE_CLIENT) {
		header("Location:create_profile.php");
		ob_flush();
}

else{
	header("Location:login.php");
	ob_flush();
}
?>

    <!-- insert the page content here -->
	<?php echo "<h1> Welcome back " . $_SESSION['user']['first_name'] . " " . $_SESSION['user']['last_name'] . "</h1>";?>
	<?php 
		if (is_dir("./profiles/".$user_id)){
			echo '<img src="./profiles/'.$user_id.'/'.$user_id.'-1" class="dashboard_pic" alt="dashboard picture"/>';
		}
		else{
			echo '<img src="./style/no_profile_image.jpg" alt="Profile Picture" class="dashboard_pic"/>';
		}
	?>	
	<p><a href="profile_images.php">Change picture</a></p>
	<p><a href="user_password_change.php">Change your password</a></p>
	<p><a href="profile_update.php">Update profile</a></p>
	<p><a href="user_update.php">Update user account information</a></p>
	<p><a href="display_profile.php?id=<?php echo $_SESSION['user']['user_id'];?>">Preview my profile</a></p>
	<br/>
	<hr/>
	<br/>
	<div class="dashboard_info">
		<?php echo "You last logged in on " . $_SESSION['last_access']; ?>
	</div>
	<br/>
			
<?php include 'footer.php';?>

