<?php 
error_reporting(~0); ini_set('display_errors', 1);
	// Author: Francis Hackenberger
	// Date: 2015-10-15
	// File: users_script.php
	// Description: A PhP script that will generate (x) users with pseudo random
	//				attributes. It will insert these users as records into the
	//				users.sql & profile.sql tables.

require 'header.php';
//require 'names.php';

	$sql = "SELECT * FROM users";
	$result = pg_query($conn, $sql);
	$records = pg_num_rows($result);
	echo "Current number of records in users table: " . $records;
	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	/*for($counter = 0; $counter < 2500; $counter++)
	{
		// USER REGISTRATION
		$login = "";
		$password = "";
		$user_type = "";
		$email_address = "";
		$first_name = "";
		$last_name = "";
		$birth_date = "";
		$date = "";
		$conn = db_connect();
		
		// GENERATE FIRST NAMES
		$min = 1;
		$max = 2;
		$rand_gender = generateRandomNumber($min, $max);	// This will generate more females than males (roughly 2:1)
		if ($rand_gender == 1)
		{
			// Male names
			$rand = array_rand($male_names);
			$first_name = $male_names[$rand];
		}
		else
		{
			// Female names
			$rand = array_rand($female_names);
			$first_name = $female_names[$rand];
		}
		//echo $first_name."\n";
		
		// GENERATE LAST NAMES
		$rand = array_rand($last_names);
		$last_name = $last_names[$rand];
		//echo $last_name."\n";
		
		// GENERATE USER ID's
		$first_initial = $first_name[0];							// Get the first initial from the first name
		$rand_id_num = generateRandomNumber(0,100);					// Used in order to pseudo guarantee a unique user_id
		$login = $first_initial . $last_name . $rand_id_num;		// Generates a pseudo random user_id
		//echo $login."\n";
		
		// GENERATE EMAIL_ADDRESSES
		$email_services = array("gmail.com","hotmail.com", "live.ca","yahoo.ca","msn.com");
		$rand = array_rand($email_services);
		$rand_email_service = $email_services[$rand];
		$email_address = $login . "@" . $rand_email_service;		// Generates a random email address using the user_id and a random service from an array
		//echo $email_address."\n";
		
		// GENERATE PASSWORDS
		$rand_password_length = generateRandomNumber(8,15);			// Generates a random password length
		$password = generateRandomString($rand_password_length);	// Generates a random password with a variable length
		$hashed_md5 = md5(SALT_FOR_HASH . $password);				// Hash the random password
		//echo $hashed_md5."\n";
		
		// GENERATE USER TYPES
		$user_types = array(CLIENT, CLIENT, CLIENT, CLIENT, CLIENT, CLIENT, CLIENT, INCOMPLETE_CLIENT, INCOMPLETE_CLIENT, INCOMPLETE_CLIENT,DISABLED_CLIENT, ADMIN, DISABLED_ADMIN);
		$rand = array_rand($user_types);
		$user_type = $user_types[$rand];							// Generates a random user type (7:3:1:1:1) ratio
		//echo $user_type."\n";
		
		// GENERATE BIRTH_DATES
		$min_date = "1970-01-01";
		$max_date = "1996-12-30";
		$birth_date = generateRandomDate($min_date, $max_date);
		//echo $birth_date."\n";
		
		// GENERATE DATES
		$min_date = "2013-01-01";
		$max_date = "2015-12-30";
		$date = generateRandomDate($min_date, $max_date);	// Generate the date (Date the account was created and last online will be the same)
		//echo $date;
		
		// INSERT THE USERS REGISTRATION INFORMATION
		$user = array($login, $hashed_md5, $user_type, $email_address, $first_name, $last_name, $birth_date, $date, $date);
		$records = pg_execute($conn, "insert_user_registration", $user);*/

			$sql = "SELECT * FROM users WHERE user_type='d'";
			$result = pg_query($conn, $sql);
			$records = pg_num_rows($result);
			$user_type = "";
		while($row=pg_fetch_assoc($result)){
			if ($row['user_type'] == DISABLED_CLIENT)
			{
				// PROFILE CREATION
				$user_id = $row['user_id'];
				$gender = 0;
				$gender_sought = 0;
				$body_type = 0;
				$city = 0;
				$age = 0;
				$age_sought = 0;
				$music_genre = 0;
				$movie_genre = 0;
				$number_of_kids = 0;
				$kids_wanted = 0;
				$number_of_pets = 0;
				$number_of_siblings = 0;
				$marital_status = 0;
				$ethnicity = 0;
				
				// GENERATE GENDER
				$min = 1;
				$max = 2;
				$rand_gender = generateRandomNumber($min, $max);	// This will generate more females than males (roughly 2:1)
				if ($rand_gender == 1)
				{
					$gender = 1;
				}
				else
				{
					$gender = 2;
				}
				//echo $gender;
				
				// GENERATE GENDER SOUGHT
				$rand_gender_sought = generateRandomNumber(1,2);	// This will generate more male genders sought than females (roughly 2:1)
				if ($rand_gender_sought != 1)
				{
					$gender_sought = 1;
				}
				else
				{
					$gender_sought = 2;
				}
				//echo $gender_sought;
				
				// GENERATE BODY_TYPE
				$body_types = array("1", "2", "4", "8", "16");
				$rand = array_rand($body_types);
				$body_type = $body_types[$rand];
				//echo $body_type;
				
				// GENERATE CITY
				$cities = array("1", "2", "4", "8", "16", "32", "64", "128");
				$rand = array_rand($cities);
				$city = $cities[$rand];
				//echo $city;
				
				// GENERATE AGE
				$ages = array("1", "2", "4", "8", "16", "32", "64", "128");
				$rand = array_rand($ages);
				$age = $ages[$rand];
				//echo $age;
				
				// GENERATE AGE_SOUGHT
				$ages_sought = array("1", "2", "4", "8", "16", "32", "64", "128");
				$rand = array_rand($ages_sought);
				$age_sought = $ages_sought[$rand];
				//echo $age_sought;
				
				// GENERATE MUSIC GENRE
				$music_genres = array("1", "2", "4", "8", "16", "32", "64", "128");
				$rand = array_rand($music_genres);
				$music_genre = $music_genres[$rand];
				//echo $music_genre;
				
				// GENERATE MOVIE GENRE
				$movie_genres = array("1", "2", "4", "8", "16");
				$rand = array_rand($movie_genres);
				$movie_genre = $movie_genres[$rand];
				//echo $movie_genre;
				
				// GENERATE NUMBER OF KIDS
				$numbers_of_kids = array("1", "2", "4", "8", "16");
				$rand = array_rand($numbers_of_kids);
				$number_of_kids = $numbers_of_kids[$rand];
				//echo $number_of_kids;
				
				// GENERATE KIDS WANTED
				$number_of_kids_wanted = array("1", "2", "4", "8", "16");
				$rand = array_rand($number_of_kids_wanted);
				$kids_wanted = $number_of_kids_wanted[$rand];
				//echo $kids_wanted;
				
				// GENERATE NUMBER OF PETS
				$numbers_of_pets = array("1", "2", "4", "8", "16");
				$rand = array_rand($numbers_of_pets);
				$number_of_pets = $numbers_of_pets[$rand];
				//echo $number_of_pets;
				
				// GENERATE NUMBER OF SIBLINGS
				$numbers_of_siblings = array("1", "2", "4", "8", "16");
				$rand = array_rand($numbers_of_siblings);
				$number_of_siblings = $numbers_of_siblings[$rand];
				//echo $number_of_siblings;
				
				// GENERATE MARITAL STATUS
				$marital_statuses = array("1", "2", "4", "8", "16", "32");
				$rand = array_rand($marital_statuses);
				$marital_status = $marital_statuses[$rand];
				//echo $marital_status;
				
				// GENERATE ETHNICITY
				$ethnicities = array("1", "2", "4", "8", "16", "32");
				$rand = array_rand($ethnicities);
				$ethnicity = $ethnicities[$rand];
				//echo $ethnicity;
				
				// GENERATE HEADLINE
				$headlines = array("Hey look at me!", "Feeling good!", "Not in the mood, well, maybe...", "Happy as can be.");
				$rand = array_rand($headlines);
				$headline = $headlines[$rand];
				
				// GENERATE SELF DESCRIPTION
				$self_descriptions = array("I'm pretty outgoing, I love variety and travelling.", "I'm daring and not afraid to express my perception of the world", "I'm only on here cause my therapist says I have to!", "Passionate, growth oriented, I love to create and manifest.");
				$rand = array_rand($self_descriptions);
				$self_description = $self_descriptions[$rand];
				
				// GENERATE MATCH_DESCRIPTION
				$match_descriptions = array("Someone that travels, likes surprises, dancing, reading, and last minute plans are a must!", "Loves living life and going outdoors, traveling, cultural events, and socializing!", "You're not afraid to say hi, how are you?", "Don't care, message me if you want to know more about me."); 
				$rand = array_rand($match_descriptions);
				$match_description = $match_descriptions[$rand];
				
				// INSERT THE USERS PROFILE INFORMATION
				$user_profile = array($user_id,$gender, $gender_sought, $body_type, $city, '0', $headline, $self_description, $match_description, $age, $age_sought, $music_genre, $movie_genre, $number_of_kids, $kids_wanted, $number_of_siblings, $marital_status, $number_of_pets, $ethnicity);
				$records_profile = pg_execute($conn, "insert_user_profile", $user_profile);
				$recorded = pg_num_rows($records_profile);
				if($recorded){
					echo "It worked";
				}
				else{
					echo "sql error occurred";
					
				}
			}
		}
		
	//}
	$sql = "SELECT * FROM users";
	$result = pg_query($conn, $sql);
	$records = pg_num_rows($result);
	echo "records in users table: " . $records;
}	
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
      
    <h1>Generate (x) random users</h1>
        
    <fieldset>    
        <input type="submit" value="Generate x users">
    </fieldset>
</form>

<?php include 'footer.php';?>