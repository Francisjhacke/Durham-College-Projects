<?php 
// Author: Francis Hackenberger - 90%
//		   Sam Chard - 10%

$fileName="profile_search.php"; 
$date="October 2015"; 
$description="The purpose of this page is for users that have an account with our website and are currently logged in as a client
			  to search for other profiles created on our website and find a match. Searches that contain only 1 record will be
			  automatically sent to that profile."; 
$title="Profile Search";
$banner="Profile Search";
include("header.php"); 
if (!isset($_SESSION['user'])) {
	$_SESSION['user_message'] = "You must login before searching for matches!";
	header("Location:login.php");
	ob_flush();
}
elseif (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == INCOMPLETE_CLIENT){
	$_SESSION['user_message'] = "You must create a profile before searching for matches!";
	header("Location:create_profile.php");
	ob_flush();
}
elseif (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == CLIENT) {
	if (isset($_SESSION['search']['cities']) && $_SESSION['search']['cities'] !== 0 || isset($_GET['city']) && $_GET['city'] !== "") {
		if ($_SERVER['REQUEST_METHOD'] == 'GET')
		{
			$cities_sum = isset($_GET['city'])?$_GET['city']:$_COOKIE['search_cities'];
			$_SESSION['search']['cities'] = $cities_sum;
			$gender_sought = isset($_COOKIE['search_gender_sought'])?$_COOKIE['search_gender_sought']:'';
			$marital_status_sum = isset($_COOKIE['search_marital_status'])?$_COOKIE['search_marital_status']:'';
			$body_type_sum = isset($_COOKIE['search_body_type'])?$_COOKIE['search_body_type']:'';
			$kids_wanted_sum = isset($_COOKIE['search_kids_wanted'])?$_COOKIE['search_kids_wanted']:'';
			$number_of_siblings_sum = isset($_COOKIE['search_number_of_siblings'])?$_COOKIE['search_number_of_siblings']:'';
			$movie_genre_sum = isset($_COOKIE['search_movie_genre'])?$_COOKIE['search_movie_genre']:'';
			$music_genre_sum = isset($_COOKIE['search']['music_genre'])?$_COOKIE['search_music_genre']:'';
			$number_of_kids_sum = isset($_COOKIE['search_number_of_kids'])?$_COOKIE['search_number_of_kids']:'';
			$number_of_pets_sum = isset($_COOKIE['search_number_of_pets'])?$_COOKIE['search_number_of_pets']:'';
			$ethnicity_sum = isset($_COOKIE['search_ethnicity'])?$_COOKIE['search_ethnicity']:'';
			$age_sought_sum = isset($_COOKIE['search_age_sought'])?$_COOKIE['search_age_sought']:'';		
		}
		else if ($_SERVER['REQUEST_METHOD'] == 'POST') 
		{
			// Clear the output label
			$output = "";
			
			$cities_sum = isset($_SESSION['search']['cities'])?$_SESSION['search']['cities']:$_COOKIE['search_cities'];
			$gender_sought = isset($_POST['gender_sought'])?$_POST['gender_sought']:'';
			$marital_status = isset($_POST['marital_status'])?$_POST['marital_status']:'';
			$body_type = isset($_POST['body_type'])?$_POST['body_type']:'';
			$kids_wanted = isset($_POST['kids_wanted'])?$_POST['kids_wanted']:'';
			$number_of_siblings = isset($_POST['number_of_siblings'])?$_POST['number_of_siblings']:'';
			$movie_genre = isset($_POST['movie_genre'])?$_POST['movie_genre']:'';
			$music_genre = isset($_POST['music_genre'])?$_POST['music_genre']:'';
			$number_of_kids = isset($_POST['number_of_kids'])?$_POST['number_of_kids']:'';
			$number_of_pets = isset($_POST['number_of_pets'])?$_POST['number_of_pets']:'';
			$ethnicity = isset($_POST['ethnicity'])?$_POST['ethnicity']:'';
			$age_sought = isset($_POST['age_sought'])?$_POST['age_sought']:'';
			
			// Get the sums of the selected checkboxes (if they have been selected) and store them in the session and cookie

			if ($gender_sought){
				$_SESSION['search']['gender_sought'] = $gender_sought;
				setcookie("search_gender_sought",$gender_sought, time() + EXPIRE_PERIOD);
			}
			else {
				setcookie("search_gender_sought", "", time() - 10);
			}
			if ($marital_status){	
				$marital_status_sum = sumCheckBox($marital_status);
				$_SESSION['search']['marital_status_sum'] = $marital_status_sum;
				setcookie("search_marital_status", $marital_status_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_marital_status", "", time() - 10);
			}
			if ($body_type){	
				$body_type_sum = sumCheckBox($body_type);
				$_SESSION['search']['body_type_sum'] = $body_type_sum;
				setcookie("search_body_type", $body_type_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_body_type", "", time() - 10);
			}
			if ($kids_wanted){	
				$kids_wanted_sum = sumCheckBox($kids_wanted);
				$_SESSION['search']['kids_wanted_sum'] = $kids_wanted_sum;
				setcookie("search_kids_wanted", $kids_wanted_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_kids_wanted", "", time() - 10);
			}
			if ($number_of_siblings){	
				$number_of_siblings_sum = sumCheckBox($number_of_siblings);
				$_SESSION['search']['number_of_siblings_sum'] = $number_of_siblings_sum;
				setcookie("search_number_of_siblings", $number_of_siblings_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_number_of_siblings", "", time() - 10);
			}
			if ($movie_genre){	
				$movie_genre_sum = sumCheckBox($movie_genre);
				$_SESSION['search']['movie_genre_sum'] = $movie_genre_sum;
				setcookie("search_movie_genre", $movie_genre_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_movie_genre", "", time() - 10);
			}
			if ($music_genre){	
				$music_genre_sum = sumCheckBox($music_genre);
				$_SESSION['search']['music_genre_sum'] = $music_genre_sum;
				setcookie("search_music_genre", $music_genre_sum, time() + EXPIRE_PERIOD); 
			}
			else{
				setcookie("search_music_genre", "", time() - 10);
			}
			if ($number_of_kids){	
				$number_of_kids_sum = sumCheckBox($number_of_kids);
				$_SESSION['search']['number_of_kids_sum'] = $number_of_kids_sum;
				setcookie("search_number_of_kids", $number_of_kids_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_number_of_kids", "", time() - 10);
			}
			if ($number_of_pets){	
				$number_of_pets_sum = sumCheckBox($number_of_pets);
				$_SESSION['search']['number_of_pets_sum'] = $number_of_pets_sum;
				setcookie("search_number_of_pets", $number_of_pets_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_number_of_pets", "", time() - 10);
			}
			if ($ethnicity){	
				$ethnicity_sum = sumCheckBox($ethnicity);
				$_SESSION['search']['ethnicity_sum'] = $ethnicity_sum;
				setcookie("search_ethnicity", $ethnicity_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_ethnicity", "", time() - 10);
			}
			if ($age_sought){	
				$age_sought_sum = sumCheckBox($age_sought);
				$_SESSION['search']['age_sought_sum'] = $age_sought_sum;
				setcookie("search_age_sought", $age_sought_sum, time() + EXPIRE_PERIOD);
			}
			else{
				setcookie("search_age_sought", "", time() - 10);
			}
			
			// Build the SQL statement based on the search criteria
			$conn = db_connect();
			$sql = "SELECT profiles.user_id FROM profiles, users";
			$sql .= " WHERE 1 = 1 AND gender_sought =".$gender_sought;
			
			// ADD THE AND + OR CLAUSES DEPENDING ON SELECTED CRITERIA(S)
			if ($marital_status){$sql .= build_search_sql(marital_status,$marital_status);}
			if ($body_type){$sql .= build_search_sql(body_type,$body_type);}
			if ($kids_wanted){$sql .= build_search_sql(kids_wanted,$kids_wanted);}
			if ($movie_genre){$sql .= build_search_sql(movie_genre,$movie_genre);}
			if ($music_genre){$sql .= build_search_sql(music_genre,$music_genre);}
			if ($number_of_kids){$sql .= build_search_sql(number_of_kids,$number_of_kids);}
			if ($number_of_pets){$sql .= build_search_sql(number_of_pets,$number_of_pets);}
			if ($ethnicity){$sql .= build_search_sql(ethnicity,$ethnicity);}
			if ($age_sought) {$sql .= build_search_sql(age_sought,$age_sought);}
			
			$sql .= " AND users.user_id = profiles.user_id AND users.user_type <> '".DISABLED_CLIENT."'";
			$sql .= " ORDER BY users.last_access DESC LIMIT ".SEARCH_LIMIT;
			//echo $sql;	// Echo the sql script (FOR TESTING PURPOSES)
			
			// Query the database looking for matches with the selected criteria
			$conn = db_connect();
			$result = pg_query($conn, $sql);
			$records = pg_num_rows($result);
			
			unset($_SESSION['matches']);		// Clear the session for new matches
			$_SESSION['records'] = $records;	// Set a records session variable for the search results page
			
			// If no matches found, display an error and ask them to expand their search criteria
			if (!$records)
			{
				$output .= "No matches found. Try expanding your search criteria";
			}
			// If only one user is found, bring them straight to that users display_profile
			elseif ($records == 1){
				$match = pg_fetch_assoc($result, 0);
				$_SESSION['matches'] = $match;
				header("Location:display_profile.php?id=".$match['user_id']."");
				ob_flush();
			}
			// If multiple matches are found, then bring them to the search_results page
			elseif ($records > 1){
				$_SESSION['count'] = 1;
				// Load matches in an a session variable (array)
				while ($matches = pg_fetch_assoc($result)){
					$_SESSION['matches'][$_SESSION['count']] = $matches['user_id'];
					$_SESSION['count'] = $_SESSION['count'] + 1;
				}
				header("Location:search_results.php");
				ob_flush();	
			}
			else{
				$output .= "An unknown error occurred!";
			}
		
		}
	}
	else{
		$_SESSION['user_message'] = "You must select a city before searching for matches!";
		header("Location:profile_select_city.php");
		ob_flush();	
	}	
}
else{
	$_SESSION['user_message'] = "Error occurred, try logging in again";
	header("Location:login.php");
	ob_flush();
}
?>
<h2> <?php echo $banner ?> </h2>
<h5> <?php echo $output ?> </h5>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
      
    <h1>Search Criteria</h1>
	<p><a href="profile_select_city.php">Change cities</a></p>
	<h4>Searching in: </h4>
	<?php 
		// Output the users selected cities
		$conn = db_connect();
		$sql = "SELECT * FROM city";
		$result = pg_query($conn, $sql);
		$i = 0;
		while($row=pg_fetch_assoc($result)){
			$selected .= (isBitSet($i,$cities_sum))? $row['property'].", ":'';
			$i++;
		}
		echo substr($selected, 0, -2);	// Echo the cities and trim the final ', ' on the end of the string
		echo nl2br("\n\n");
	?>
    <fieldset>  
	<?php
		// Build the gender sought radio button
		buildRadioButton("gender_sought", $gender_sought);
	
		// Build the checkboxes
		buildCheckBox("age_sought", $age_sought_sum);
		buildCheckBox("ethnicity", $ethnicity_sum);
		buildCheckBox("body_type", $body_type_sum);
		buildCheckBox("marital_status", $marital_status_sum);
		buildCheckBox("kids_wanted", $kids_wanted_sum);
		buildCheckBox("number_of_pets", $number_of_pets_sum);
		buildCheckBox("number_of_siblings", $number_of_siblings_sum);
		buildCheckBox("movie_genre", $movie_genre_sum);
		buildCheckBox("music_genre", $music_genre_sum);
	?>
	<input type="submit" value="Search">
	</fieldset>
</form>
<?php include("footer.php"); ?>