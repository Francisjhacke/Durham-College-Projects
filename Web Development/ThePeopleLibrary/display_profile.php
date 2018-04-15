<!-- DECLARATIONS -->
<?php 
	// Francis Hackenberger - %80
	// Sam Chard - 20%
	$fileName = "display_profile.php";
	$pageTitle = "Display Profile"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "2015-11-05";
	$description = "The purpose of this page is to display a users profile
					so that other users can get information like their
					description, profile picture, and other details. On this page
					they can also 'check out' the profile or in other words show
					interest in the person. ";	  
?>

<?php include 'header.php';?>

<?php 
if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == CLIENT || $_SESSION['user']['user_type'] == ADMIN){
		
	if (isset($_GET['id']) && $_GET['id'] !== "" && $_SESSION['profile_info'] !== ""){
		
		$gender = "";
		$gender_sought = "";
		$age = "";
		$age_sought = "";
		$marital_status ="";
		$number_of_kids = "";
		$number_of_siblings ="";
		$number_of_pets ="";
		$movie_genre ="";
		$music_genre = "";
		$kids_wanted =""; 
		$body_type = "";
		$ethnicity = "";
	
		// LOAD THE MATCH'S INFORMATION
		$conn = db_connect();
		$match_user_id = array($_GET['id']);
		$result = pg_execute($conn, "query_profile_info", $match_user_id);
		$profile_info = pg_fetch_assoc($result);
		
		$_SESSION['profile_info'] = $profile_info;
		
		$gender = getProperty(gender, $profile_info['gender']);
		$gender_sought = getProperty(gender_sought, $profile_info['gender_sought']);
		$age = getProperty(age, $profile_info['age']);
		$age_sought = getProperty(age_sought, $profile_info['age_sought']);
		$marital_status = getProperty(marital_status, $profile_info['marital_status']);
		$number_of_kids = getProperty(number_of_kids, $profile_info['number_of_kids']);
		$number_of_siblings = getProperty(number_of_siblings, $profile_info['number_of_siblings']);
		$number_of_pets = getProperty(number_of_pets, $profile_info['number_of_pets']);
		$movie_genre = getProperty(movie_genre, $profile_info['movie_genre']);
		$music_genre = getProperty(music_genre, $profile_info['music_genre']);
		$kids_wanted = getProperty(kids_wanted, $profile_info['kids_wanted']);
		$body_type = getProperty(body_type, $profile_info['body_type']);
		$ethnicity = getProperty(ethnicity, $profile_info['ethnicity']);	
	}
	if($_POST['report_offensive']){
		// Retrieve the report information
		$reported_by = $_SESSION['user']['user_id'];
		$offensive_user = $_SESSION['profile_info']['user_id'];
		$time_stamp = date("Y-m-d");
		$status = INCOMPLETE_OFFENSIVE_STATUS;
		// Store the information in the array
		$report_information = array($reported_by, $offensive_user, $time_stamp, $status);
		$report_query = array($reported_by, $offensive_user);
		
		// Check if the user has already reported this account
		$result = pg_execute($conn, "query_offensives", $report_query);
		$row = pg_num_rows($result);
		// The user hasn't been reported by this user yet
		if($row){
			echo "You have already reported this user";
		}
		else{
			// Execute the prepared statement
			$result = pg_execute($conn, "insert_report_offensive", $report_information);
			$row = pg_num_rows($result);
			echo "Successfully reported user";
		}
	}
	elseif($_POST['show_interest']){	
		// Retrieve the interest information
		$interested_user = $_SESSION['user']['user_id'];
		$users_interest = $_SESSION['profile_info']['user_id'];
		$time_stamp = date("Y-m-d");
		// Store the information in the array
		$interest_information = array($interested_user, $users_interest, $time_stamp);
		
		// Execute the prepared statement
		$result = pg_execute($conn, "insert_interest", $interest_information);
		$row = pg_num_rows($result);
		echo "Successfully interested in user";
	}
		
	elseif($_POST['remove_interest']){	
		// Retrieve the interest information
		$interested_user = $_SESSION['user']['user_id'];
		$users_interest = $_SESSION['profile_info']['user_id'];
		// Store the information in the array
		$interest_information = array($interested_user, $users_interest);
		
		// Execute the prepared statement
		$result = pg_execute($conn, "remove_interest", $interest_information);
		echo "Successfully removed interest in user";
	}
	elseif($_POST['enable_user']){	
		// Retrieve the interest information
		$interested_user = $_SESSION['user']['user_id'];
		$users_interest = $_SESSION['profile_info']['user_id'];
		// Store the information in the array
		$profile_users_info = array(CLIENT, $users_interest);
		
		// Execute the prepared statement
		$result = pg_execute($conn, "update_user_type", $profile_users_info);
		echo "Successfully enabled user";
	}
	elseif($_POST['disable_user']){	
		// Retrieve the interest information
		$interested_user = $_SESSION['user']['user_id'];
		$users_interest = $_SESSION['profile_info']['user_id'];
		// Store the information in the array
		$profile_users_info = array(DISABLED_CLIENT, $users_interest);
		
		// Execute the prepared statement
		$result = pg_execute($conn, "update_user_type", $profile_users_info);
		echo "Successfully disabled user";
	}
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


<form method="post" action="<?php echo $_SERVER['PHP_SELF']."?id=".$_SESSION['profile_info']['user_id']; ?>" >
	<fieldset>
		<?php 
			if($_SESSION['user']['user_type'] == ADMIN){
				// Query profiles user id to see if they are disabled
				// if disabled show a enable button
				$user_type_info = array($_GET['id']);
				$result = pg_execute($conn, "query_user_info", $user_type_info);
				$info = pg_fetch_assoc($result);
				if ($info['user_type'] == DISABLED_CLIENT){
					$output .= "<input type='submit' name = 'enable_user' value = 'Enable User'/>";
				}
				else {
					// if not disabled show a disable button
					$output .= "<input type='submit' name = 'disable_user' value = 'Disable User'/>";
				}
			}
			else{
				$output = "";	// The output to return
				$interested_user_id = $_GET['id'];
				$user_id = $_SESSION['user']['user_id'];
				$myInterest = array($user_id, $interested_user_id);
				$result = pg_execute($conn, "query_interest", $myInterest);
				$rows = pg_num_rows($result);
				
				// If interest was found, then display a remove interest button
				if ($rows){
					$output .= "<input type='submit' name = 'remove_interest' value = 'Remove Interest'/>";
				}
				// Else no interest was found, display a show interest button
				else{
					$output .= "<input type='submit' name = 'show_interest' value = 'Show Interest'/>";
				} 		
			}
			echo $output;
		?>
		<input type='submit' name = 'report_offensive' value = 'Report'/>
	</fieldset>
</form>


<h2 class="center"> <?php echo $_SESSION['profile_info']['user_id'];?> </h2>
<img class="profile_pic" src="./style/no_profile_image.jpg" alt="Profile Picture"/>	
<br/>
<br/>

<h2 class="center">Description: </h2>
<p class="profile_description"> <?php echo $_SESSION['profile_info']['self_description'];?></p>
<h2 class="center">Match Description: </h2>
<p class="profile_description"><?php echo $_SESSION['profile_info']['match_description'];?></p>
<br/>
<hr/>
<br/>

<table>
	<tr>
		<th>Details</th>
		<th>Answers</th>
	</tr>
	<tr>
		<td>Gender: </td>
		<td><?php echo getProperty(gender, $_SESSION['profile_info']['gender']);?></td>
	</tr>
	<tr>
		<td>Seeking: </td>
		<td><?php echo getProperty(gender_sought, $_SESSION['profile_info']['gender_sought']);?></td>
	</tr>
	<tr>
		<td>Body Type:</td>
		<td><?php echo getProperty(body_type, $_SESSION['profile_info']['body_type']);?></td>
	</tr>
	<tr>
		<td>Ethnicity:</td>
		<td><?php echo getProperty(ethnicity, $_SESSION['profile_info']['ethnicity']);?></td>
	</tr>
	<tr>
		<td>Age:</td>
		<td><?php echo getProperty(age, $_SESSION['profile_info']['age']);?></td>
	</tr>
	<tr>
		<td>Age Sought:</td>
		<td><?php echo getProperty(age_sought, $_SESSION['profile_info']['age_sought']);?></td>
	</tr>
	<tr>
		<td>Number Of Kids:</td>
		<td><?php echo getProperty(number_of_kids, $_SESSION['profile_info']['number_of_kids']);?></td>
	</tr>
	<tr>
		<td>Number Of Pets:</td>
		<td><?php echo getProperty(number_of_pets, $_SESSION['profile_info']['number_of_pets']);?></td>
	</tr>
	<tr>
		<td>Number Of Siblings: </td>
		<td><?php echo getProperty(number_of_siblings, $_SESSION['profile_info']['number_of_siblings']);?></td>
	</tr>
	<tr>
		<td>Kids Wanted:</td>
		<td><?php echo getProperty(kids_wanted, $_SESSION['profile_info']['kids_wanted']);?></td>
	</tr>
	<tr>
		<td>Movie Genre:</td>
		<td><?php echo getProperty(movie_genre, $_SESSION['profile_info']['movie_genre']);?></td>
	</tr>
	<tr>
		<td>Music Genre:</td>
		<td><?php echo getProperty(music_genre, $_SESSION['profile_info']['music_genre']);?></td>
	</tr>
	<tr>
		<td>Marital Status:</td>
		<td><?php echo getProperty(marital_status, $_SESSION['profile_info']['marital_status']);?></td>
	</tr>
</table>
<br/>


<?php include("footer.php"); ?>