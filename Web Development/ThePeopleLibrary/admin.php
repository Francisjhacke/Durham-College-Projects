<?php 
// Author: Sam Chard 30%
//		   Francis Hackenberger 70%
$fileName="admin.php" ?>
<?php $date="November 2015" ?>
<?php $description="The purpose of this page is to be the page
that admins are directed to when they log in." ?>
<?php $title="People Library - Admin" ?>
<?php $banner="Administrator page" ?>
<?php include("header.php"); ?>
<h2> <?php echo $banner ?> </h2>

<?php 
if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == ADMIN){
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		// Variable declarations
		$output = "";		// Clear for new output
		$conn = db_connect();
		
		if($_POST['session_info']){
			$session_info = print_r($_SESSION, true);
			$output .= "<h4> Session Information </h4>";
			$output .= "<pre>".$session_info."</pre>";
		}
		
		if($_POST['cookie_info']){
			$cookie_info = print_r($_COOKIE, true);
			$output .="<h4> Cookie Information </h4>";
			$output .="<pre>".$cookie_info."</pre>";
		}
		
		if($_POST['reported_profiles']){
			$output .="<h4> Reported Profiles </h4>";
			$reported_user_type = array(INCOMPLETE_OFFENSIVE_STATUS);
			$result = pg_execute($conn, "query_reported_users", $reported_user_type);
			$reported_users_num = pg_num_rows($result);
			
			if ($reported_users_num){
				$output .="<table><tr><th>Reported By</th><th>Offensive User</th><th>Date</th></tr>";
				while($row=pg_fetch_assoc($result)){
					$output .="<tr>";
					$output .= "<td><a href='display_profile.php?id=".$row['reported_by']."'>".$row['reported_by']."</a></td>";
					$output .= "<td><a href='display_profile.php?id=".$row['offensive_user']."'>".$row['offensive_user']."</a></td>";
					$output .= "<td>".$row['time_stamp']."</td>";
					$output .="</tr>";
				}
				$output .="</table>";
			}
			else{
				$output .= "No reported users found.";
			}
		}
	}
}

// If they are not of admin user_type they are sent to the index page without any other information.
else{
	header("Location:index.php");
	ob_flush();
}
?>

<p>Welcome to the Administrator page.</p>

<h3><?php echo $_SESSION['user']['user_id'];?></h3>
<h3><?php echo "You last logged in on <b>" . $_SESSION['last_access'] . "</b>"; ?></h3>

<?php echo $output; ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<fieldset>
		<input type="submit" name="session_info" value = "Session Information"/>
		<input type="submit" name="cookie_info" value = "Cookie Information"/>
		<input type="submit" name="reported_profiles" value = "View Reported Profiles"/>
	</fieldset>
</form>

<?php include("footer.php"); ?>
