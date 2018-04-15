<!--
	Author: Francis Hackenberger - 100%
	Filename: <?php echo $fileName ?>
	Date: <?php echo $date ?>
	Description: <?php echo $description ?>
	-->

<?php 

define("SALT_FOR_HASH","group20");					//To hash passwords 

define("MINIMUM_ID_LENGTH", "5");					//Minimum ID length of 5 characters

define("MAXIMUM_ID_LENGTH", "20");					//Maximum ID length of 20 characters		

define("MINIMUM_PASSWORD_LENGTH", "6");				//Minimum password length of 6 characters

define("MAXIMUM_PASSWORD_LENGTH", "12");			//Maximum password length of 20 characters

define("MINIMUM_FIRST_NAME_LENGTH", "2");			//Minimum number of characters length for user first name

define("MAXIMUM_FIRST_NAME_LENGTH", "40");			//Maximum number of characters length for user first name 

define("MINIMUM_LAST_NAME_LENGTH", "2");			//Minimum number of characters length for user last name

define("MAXIMUM_LAST_NAME_LENGTH", "40");			//Maximum number of characters length for user last name

define("MINIMUM_BIRTH_DAY", "1");					//Minimum number of days in a month

define("MAXIMUM_BIRTH_DAY", "31");					//Maximum number of days in a month

define("MINIMUM_BIRTH_MONTH", "1");					//Minimum number of months in a year

define("MAXIMUM_BIRTH_MONTH", "12");				//Maximum number of months in a year

define("MINIMUM_BIRTH_YEAR", "1901");				//Minimum number of years

define("MAXIMUM_BIRTH_YEAR", "2015");				//Maximum year someone could be born

define("MINIMUM_AGE", "18");						//Minimum acceptable age to use the website

define("CLIENT", "c");								//Set CLIENT = c

define("ADMIN", "a");								//Set ADMIN = a

define("INCOMPLETE_CLIENT", "i");					//Set INCOMPLETE_CLIENT = i

define("DISABLED_CLIENT", "d");						//Set DISABLED_CLIENT = d

define("DISABLED_ADMIN", "x");						//Set DISABLED_ADMIN = x

define("EXPIRE_PERIOD", "2592000");					//Constant for cookies!!! 60 * 60 * 24 * 30 = 2592000 seconds 

define("MINIMUM_NUMBER_OF_IMAGES", "1");			//Set minimum number of images acceptable for this user

define("MAXIMUM_NUMBER_OF_IMAGES", "20");			//Set maximum number of images acceptable for this user

define("SEARCH_LIMIT", "200");						//Set maximum number of search results that may be queried

define("RECORDS_PER_PAGE_LIMIT", "10");				//Set maximum number of records shown per page

define("PAGE_NUM_RANGE", "3");						//The page number range to display (pagination)

define("FILE_UPLOAD_LIMIT", "2000000");				//The maximum file size that may be uploaded

define("MAXIMUM_PROFILE_IMAGES", "5");				//The maximum number of images that may be uploaded

define("INCOMPLETE_OFFENSIVE_STATUS", 'i');			//The status of a reported user that is not banned yet

define("COMPLETE_OFFENSIVE_STATUS", 'c');			//The status of an completed offensive user (Banned)

?>