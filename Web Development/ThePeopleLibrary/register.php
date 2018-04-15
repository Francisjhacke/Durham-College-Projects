<?php 
	$fileName = "register.php";
	$pageTitle = "Register"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "2015-09-26";
	$description = "The purpose of this page is for new users or users of incomplete status to register
					an account with our website. They will be prompted to enter
					their username, password, email address, date of birth, first name
					and last name.";	  
?>

<?php include 'header.php';?>	

<!-- INSERT AND VALIDATE REGISTRATION -->
<?php
$login = "";
$password = "";
$confirm_password = "";
$email_address = "";
$birth_day = "";
$birth_month = "";
$birth_year = "";
$first_name = "";
$last_name = "";
$date = "";
$valid = true;
$output = "";
$user_type = INCOMPLETE_CLIENT;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$login = trim($_POST['login']);
	$password = trim($_POST['pass']);
	$confirm_password = trim($_POST['confirm_pass']);
	$birth_day = trim($_POST['birth_day']);
	$birth_month = trim($_POST['birth_month']);
	$birth_year = trim($_POST['birth_year']);
	
	$email_address = trim($_POST['email_address']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$date = date("Y-m-d");
	$conn = db_connect();

	// AGE VALIDATION
	if ($birth_day == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter a birth day");
	}
	else
	{
		if ($birth_day < MINIMUM_BIRTH_DAY || $birth_day > MAXIMUM_BIRTH_DAY)
		{
			$valid = false;
			$output .= nl2br("\nBirthday must be larger than " .MINIMUM_BIRTH_DAY. " and smaller than " .MAXIMUM_BIRTH_DAY. ".");
		}
	}
	if ($birth_month == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter a birth month");
	}
	else
	{
		if ($birth_month < MINIMUM_BIRTH_MONTH || $birth_month > MAXIMUM_BIRTH_MONTH)
		{
			$valid = false;
			$output .= nl2br("\nBirth month must be larger than " .MINIMUM_BIRTH_MONTH. " and smaller than " .MAXIMUM_BIRTH_MONTH. ".");
		}
	}
	if ($birth_year == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter a birth year");
	}
	else
	{
		if ($birth_year < MINIMUM_BIRTH_YEAR || $birth_year > MAXIMUM_BIRTH_YEAR)
		{
			$valid = false;
			$output .= nl2br("\nBirth year must be larger than " .MINIMUM_BIRTH_YEAR. " and smaller than " .MAXIMUM_BIRTH_YEAR. ".");
		}
	}
	
	// BIRTHDATE IS VALID, CHECK AGE
	if ($valid)
	{
		$birth_date = $birth_year . "-" . $birth_month . "-" . $birth_day;
		// Check if birth date is over minimum age
		$age = calculateAge($birth_date);
		if ($age < MINIMUM_AGE)
		{
			$valid = false;
			$output .= nl2br("\nYou must be over " . MINIMUM_AGE . " to register for this website.");
		}
	}
	
	// USERNAME VALIDATION (LOGIN)
	if ($login == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter a username.");
	}
	else
	{
		$myLogin = array($login);
		$result = pg_execute($conn, "query_user_id", $myLogin);
		$records = pg_num_rows($result);
		
		// Check if that username is already taken
		if ($records) 
		{
			$valid = false;
			$output .= nl2br("\nThat username is already taken!");
		}
		else
		{
			if (strlen($login) < MINIMUM_ID_LENGTH || strlen($login) > MAXIMUM_ID_LENGTH)
			{
				$valid = false;
				$output .= nl2br("\nYour username must be longer than " . MINIMUM_ID_LENGTH . " and smaller than " . MAXIMUM_ID_LENGTH . ".");
			}
		}
	}
			
	// PASSWORD VALIDATION
	if ($password == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter a password.");
	}
	else
	{
		if (strcmp($password, $confirm_password) !== 0)
		{
			$valid = false;
			$output .= "The passwords entered did not match </br>";
			$password = "";
			$confirm_password = "";
		}
		
		elseif (strlen($password) < MINIMUM_PASSWORD_LENGTH)
		{
			$valid = false;
			$output .= nl2br("\nPassword must be longer than " . MINIMUM_PASSWORD_LENGTH . " characters, symbols, or numbers.");
		} 
		else 
		{
			$hashed_md5 = md5(SALT_FOR_HASH . $password);
		}
	}
			
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
	}
			
	// FIRST NAME VALIDATION
	if ($first_name == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter a first name.");
	}
	else
	{
		if (strcspn($first_name, '0123456789') != strlen($first_name))
		{
			$valid = false;
			$output .= nl2br("\nYour first name cannot contain numbers.");
		}
		else
		{
			if (strlen($first_name) < MINIMUM_FIRST_NAME_LENGTH)
			{
				$valid = false;
				$output .= nl2br("\nYour first name must be longer than " . MINIMUM_FIRST_NAME_LENGTH ." characters");
			}
		}
	}
	// LAST NAME VALIDATION
	if ($last_name == "")
	{
		$valid = false;
		$output .= nl2br("\nYou must enter a last name.");
	}
	else
	{
		if (strcspn($last_name, '0123456789') != strlen($last_name))
		{
			$valid = false;
			$output .= nl2br("\nYour last name cannot contain numbers.");
		}
		else
		{
			if (strlen($first_name) < MINIMUM_LAST_NAME_LENGTH)
			{
				$valid = false;
				$output .= nl2br("\nYour first name must be longer than " . MINIMUM_LAST_NAME_LENGTH . " characters");
			}
		}
	}
			
	// IF ALL FIELDS ARE VALID
	if ($valid)
	{		
		$user = array($login, $hashed_md5, $user_type, $email_address, $first_name, $last_name, $birth_date, $date, $date);
		$records = pg_execute($conn, "insert_user_registration", $user);
		if ($records)
		{
			$_SESSION['user_type'] = $user_type;
			header("Location:create_profile.php");
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
	}
}
?>
<?php echo $output ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
      
        <h1>Register</h1>
        
        <fieldset>     	        
		  
		  <label for="login">Username: </label>
          <input type="text" id="login" name="login" value="<?php echo $login?>"/>
		  
		  <label for="pass">Password: </label>
          <input type="password" id="pass" name="pass" value="<?php echo $password?>"/>
		 
		 <label for="confirm_pass">Confirm Password: </label>
          <input type="password" id="confirm_pass" name="confirm_pass" value="<?php echo $confirm_password?>"/>
		  
		  <label for="first_name">First Name: </label>
          <input type="text" id="first_name" name="first_name" value="<?php echo $first_name?>"/>
		  
		  <label for="last_name">Last Name: </label>
          <input type="text" id="last_name" name="last_name" value="<?php echo $last_name?>"/>
		  
		  <label for="email_address">Email Address: </label>
          <input type="text" id="email_address" name="email_address" value="<?php echo $email_address?>"/>
		  
		  <label for="birth_day">Birth Day:</label>
		  <input type="text" id="birth_day" name="birth_day" value="<?php echo $birth_day?>"/>
		  <label for="birth_month">Birth Month:</label>
		  <input type="text" id="birth_month" name="birth_month" value="<?php echo $birth_month?>"/>
		  <label for="birth_year">Birth Year:</label>
		  <input type="text" id="birth_year" name="birth_year" value="<?php echo $birth_year?>"/>
		  
          <input type="submit" value = "Register"/>   
        </fieldset>	
		
      </form>
<?php include 'footer.php';?>