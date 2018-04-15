<!-- DECLARATIONS -->
<?php 
error_reporting(~0); ini_set('display_errors', 1);
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
if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_type'] == INCOMPLETE_CLIENT)
{
	// CLEAR VARIABLES FOR INPUT
	$headline = "";
	$self_description = "";
	$match_description = "";

	$valid = true;
	$output = "";
	$user_id = $_SESSION['user']['user_id'];
		
	if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if (isset($_SESSION['user_message'])){
		echo $_SESSION['user_message'];
		}
		$city = 0;
		$gender = 0;
		$gender_sought = 0;
		$marital_status = 0;
		$body_type = 0;
		$kids_wanted = 0;
		$number_of_siblings = 0;
		$movie_genre = 0;
		$music_genre = 0;
		$number_of_kids = 0;
		$number_of_pets = 0;
		$user_type = 'c';
		$ethnicity = 0;
		$age = 0;
		$age_sought = 0;
	}else if ($_SERVER['REQUEST_METHOD'] == 'POST')
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
		$user_type = CLIENT;
		
		// Connect to the database
		$conn = db_connect();
		
		
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
			// Create the users profile & insert the values selected
			$user_profile = array($user_id,$gender, $gender_sought, $body_type, $city, '0', $headline, $self_description, $match_description, $age, $age_sought, $music_genre, $movie_genre, $number_of_kids, $kids_wanted, $number_of_siblings, $marital_status, $number_of_pets, $ethnicity);
			$user_update_type = array($user_type, $user_id); 
			$records_type = pg_execute($conn, "update_user_type", $user_update_type);
			$records_profile = pg_execute($conn, "insert_user_profile", $user_profile);
			
			if ($records_profile)
			{
				$_SESSION['user_message'] = "You have completed the registration process! You're ready to start checking out!";
				header("Location:login.php");
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
	else 	// This user is not an incomplete user, send them to the login page
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
	
		buildRadioButton("gender", $gender);
		buildRadioButton("gender_sought", $body_type);
		buildRadioButton("kids_wanted", $kids_wanted);

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
        <input type="text" id="headline" name="headline" value="<?php $headline; ?>"/>
		
		<label for="self_description">Self Description</label>
        <input type="text" id="self_description" name="self_description" value="<?php $self_description;?>"/>
		
		<label for="match_description">Match description</label>
        <input type="text" id="match_description" name="match_description" value="<?php $match_description;?>"/>
        
        <input type="submit" value="Submit">
    </fieldset>
</form>
<?php include 'footer.php';?>