<!-- DECLARATIONS -->
<?php 
	$fileName = "user_update.php";
	$pageTitle = "User Update"; 
	$banner = "user update";
	$date = "2015-11-16";
	$description = "The purpose of this page is to give the
					users the ability to update their user
					information (account related).";	  
?>

<?php include 'header.php';?>	

<!-- INSERT AND VALIDATE PROFILE REGISTRATION -->
<?php
if (isset($_SESSION['user']['user_id']) && $_SESSION['user']['user_type'] == CLIENT)
{
	// CLEAR VARIABLES FOR INPUT
	$valid = true;
	$output = "";
		
	// LOAD THE USER'S INFORMATION
	$conn = db_connect();
	$user_id = array($_SESSION['user']['user_id']);
	$result = pg_execute($conn, "query_user_info", $user_id);
	$user_info = pg_fetch_assoc($result);

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		// SET VARIABLES
		$birth_date = trim($_POST['birth_date']);
		$email_address = trim($_POST['email_address']);
		$first_name = trim($_POST['first_name']);
		$last_name = trim($_POST['last_name']);
		
		$birth_day = substr($birth_date,8,2);
		$birth_month = substr($birth_date,5,2);
		$birth_year = substr($birth_date,0,4);
		
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
			// Check if birth date is over minimum age
			$age = calculateAge($birth_date);
			if ($age < MINIMUM_AGE)
			{
				$valid = false;
				$output .= nl2br("\nYou must be over " . MINIMUM_AGE . " to register for this website.");
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
			$user_info = array($email_address, $first_name, $last_name, $birth_date, $user_id);
			$records = pg_execute($conn, "user_update", $user_info);
			if ($records)
			{
				$_SESSION['user_message'] = "Your account has been updated!";
				header("Location:dashboard.php");
				ob_flush();
			}
			// Error updating record
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
}
?>

<?php echo $output;?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
      
	<h1>User update</h1>
	
	<fieldset>     	         
	  <h2><?php echo $_SESSION['user']['user_id'];?></h2>  
	  
	  <label for="first_name">First Name: </label>
	  <input type="text" id="first_name" name="first_name" value="<?php echo $user_info['first_name'];?>"/>
	  
	  <label for="last_name">Last Name: </label>
	  <input type="text" id="last_name" name="last_name" value="<?php echo $user_info['last_name'];?>"/>
	  
	  <label for="email_address">Email Address: </label>
	  <input type="text" id="email_address" name="email_address" value="<?php echo $user_info['email_address'];?>"/>
	  
	  <label for="birth_date">Birth Date: (YYYY-MM-DD)</label>
	  <input type="text" id="birth_date" name="birth_date" value="<?php echo $user_info['birth_date'] ?>"/>

	  <input type="submit" value = "Update"/>   
	</fieldset>	
		
 </form>
<?php include 'footer.php';?>