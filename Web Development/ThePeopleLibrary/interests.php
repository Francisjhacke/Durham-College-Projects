<!-- DECLARATIONS -->
<?php 
	// Author: Francis Hackenberger - 100%
	$fileName = "interests.php";
	$pageTitle = "Interests"; 
	$banner = "Interests";
	$date = "2015-12-04";
	$description = "The purpose of this page is for users to see
					their interests and who is interested in them.
					Additionally, if a user is interested in another user and that
					user is interested in them, it will highlight the matches.";	  
					
?>

<?php include 'header.php';?>	
<?php
if (isset($_SESSION['user_message'])){
		echo $_SESSION['user_message']."\n";
		unset($_SESSION['user_message']);
}

if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == CLIENT){
	$output = "";
	$conn = db_connect();
	$user_info = array($_SESSION['user']['user_id']);
		
	if(isset($_GET['action'])){
		// Check if they want to remove a user from their interests
		if($_GET['action'] == "remove_interested_in"){
			$interest_table_info = array($_GET['mode'],$_SESSION['user']['user_id']);
			$result = pg_execute($conn, "remove_interest", $interest_table_info);
			if ($result){
				echo "Removed " . $_GET['mode'] . " from interests in you.";
			}
			else{
				echo "sql error occurred, try again please.";
			}
		}
		
		// Check if they want to remove someone interested in them
		if($_GET['action'] == "remove_my_interest"){
			$interest_table_info = array($_SESSION['user']['user_id'], $_GET['mode']);
			$result = pg_execute($conn, "remove_interest", $interest_table_info);
			if ($result){
				echo "Removed " . $_GET['mode'] . " from your interests.";
			}
			else{
				echo "sql error occurred, try again please.";
			}
		}
	}
	
	// Query users that are interested in you
	$result_interested_in = pg_execute($conn, "query_interested_in", $user_info);
	// Query the current users interests
	$result_interests = pg_execute($conn, "query_user_interests", $user_info);
	
	// Generate the Interested In You Table
	$output .= "<table><tr><th>Interested In You</th><th>Option</th></tr>";
	while($row=pg_fetch_assoc($result_interested_in)){
		$output .= "<tr><td><a href='display_profile.php?id=".$row['user_id']."'>".$row['user_id']."</a></td>";
		$output .= "<td><a href='interests.php?action=remove_interested_in&mode=".$row['interest_id']."'>Remove Interest</a></td>";
		$output .= "</tr>";
	}
	$output .= "</table>";
	$output .= "<br/><hr/><br/>";
	
	// Generate the Your Interests Table
	$output .= "<table><tr><th>Your Interests</th><th>Option</th></tr>";
	while($row=pg_fetch_assoc($result_interests)){
		$output .= "<tr><td><a href='display_profile.php?id=".$row['interest_id']."'>".$row['interest_id']."</a></td>";
		$output .= "<td><a href='interests.php?action=remove_my_interest&mode=".$row['interest_id']."'>Remove Interest</a></td>";
		$output .= "</tr>";
	}
	$output .= "</table>";

}
else{
	$_SESSION['user_message'] = "You must be logged in as a completed client to view this page";
	header("Location:login.php");
	ob_flush();
}

?>

<h2>Profile Interests</h2>
<?php echo $output; ?>

			
<?php include 'footer.php';?>

