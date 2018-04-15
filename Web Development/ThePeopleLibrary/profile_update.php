<!-- DECLARATIONS -->
<?php 
	$fileName = "create_profile.php";
	$pageTitle = "Create Profile"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "2015-09-24";
	$description = "The purpose of this page is for users to create 
					their dating profile. It will include fields such as their
					gender, what gender their seeking, their body type, hair colour,
					eye colour, etc...";	  
?>

<?php include 'header.php';?>	

<!-- INSERT AND VALIDATE PROFILE REGISTRATION -->
<?php
if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_type'] == CLIENT)
{
	$valid = true;
	$output = "";
	$user_id = array($_SESSION['user']['user_id']);

	// LOAD THE MATCH'S INFORMATION
	$conn = db_connect();
	$result = pg_execute($conn, "query_profile_info", $user_id);
	$profile_info = pg_fetch_assoc($result);
	
	if (isset($_SESSION['user_message'])){
	echo $_SESSION['user_message'];
	}
	
	//print_r($profile_info);
	
	$city = getProperty(city,$profile_info['city']);
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
		
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		// SET VARIABLES
		$gender = $_POST['gender'];
		$gender_sought = $_POST['gender_sought'];
		$ethnicity = $_POST['ethnicity'];
		$body_type = $_POST['body_type'];
		$city = $_POST['city'];
		$marital_status = $_POST['marital_status'];
		$age = $_POST['age'];
		$age_sought = $_POST['age_sought'];
		$music_genre = $_POST['music_genre'];
		$movie_genre = $_POST['movie_genre'];
		$kids_wanted = $_POST['kids_wanted'];
		$number_of_siblings = $_POST['number_of_siblings'];
		$number_of_pets = $_POST['number_of_pets'];
		$number_of_kids = $_POST['number_of_kids'];
		$headline = $_POST['headline'];
		$self_description = $_POST['self_description'];
		$match_description = $_POST['match_description'];

		// Validate that user has entered something in the textbox fields
		if ($headline == "")
		{
			$valid = FALSE;
			$output .= "You must enter a headline";
		}
		if ($self_description == "")
		{
			$valid = FALSE;
			$output .= "You must enter a self description";
		}
		if ($match_description == "")
		{
			$valid = FALSE;
			$output .= "You must enter a match description";
		}
		
		if($valid)
		{
			// UPDATE USERS INFORMATION
			$user_profile = array($gender, $gender_sought, $body_type, $city, $headline, $self_description, $match_description, $age, $age_sought, $music_genre, $movie_genre, $kids_wanted, $number_of_siblings, $marital_status, $ethnicity, $_SESSION['user']['user_id']);
			$records_profile = pg_execute($conn, "profile_update", $user_profile);
			
			if ($records_profile)
			{
				$_SESSION['user_message'] = "You have updated your profile!";
				header("Location:dashboard.php");
				ob_flush();
			}
			// Error inserting records
			else
			{
				$output .= "An sql error occurred!";
			}
		}
		else
		{
			$output .= "Oopz something you entered wasn't valid!";
		}
	}
}	
	else 	// This user is not a complete user, send them to the login page
	{
		header("Location:login.php");
		ob_flush();
	}

	echo $output;
?>


<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
      
    <h1>Create your profile</h1>
        
    <fieldset>  
	<?php 
	
		buildRadioButton("gender", $profile_info['gender']);
		buildRadioButton("gender_sought", $profile_info['gender_sought']);
		buildRadioButton("kids_wanted", $profile_info['kids_wanted']);

		buildDropDown("body_type", $body_type);
		buildDropDown("ethnicity", $ethnicity);
		buildDropDown("city", $city);
		buildDropDown("number_of_siblings", $number_of_siblings);
		buildDropDown("number_of_pets", $number_of_pets);
		buildDropDown("number_of_kids", $number_of_kids);
		buildDropDown("music_genre", $music_genre);
		buildDropDown("movie_genre", $movie_genre);
		buildDropDown("marital_status", $marital_status);
		buildDropDown("age", $age);
		buildDropDown("age_sought", $age_sought);
		
	?>
		<label for="headline">Headline</label>
        <input type="text" id="headline" name="headline" value="<?php echo $profile_info['headline']; ?>"/>
		
		<label for="self_description">Self Description</label>
        <input type="text" id="self_description" name="self_description" value="<?php echo $profile_info['self_description'];?>"/>
		
		<label for="match_description">Match description</label>
        <input type="text" id="match_description" name="match_description" value="<?php echo $profile_info['match_description'];?>"/>
        
        <input type="submit" value="Submit">
    </fieldset>
</form>
<?php include 'footer.php';?>