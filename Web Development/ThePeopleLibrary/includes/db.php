<?php
	// Francis Hackenberger - 100%
	// File: db.php
	// Author: Group 20
	// Date Modified: 2015-11-03
	// Description: This php file contains all of our database
	// 				related functions (including one that will
	//				connect to the database).

function db_connect(){
	$connection = pg_connect("host=127.0.0.1 dbname=group20_db user=group20_admin password=FFEDs20" );
return $connection;
}
	$conn = db_connect();
	
	// Query USER ID
	$sql_user_id = "SELECT user_id FROM users WHERE user_id = $1";
	$stmt1 = pg_prepare($conn, "query_user_id", $sql_user_id);
	
	// query USER PROFILE information
	$sql_profile = "SELECT * FROM profiles WHERE user_id = $1";
	$stmt7 = pg_prepare($conn, "query_profile_info", $sql_profile);
	
	// Query USER information
	$sql_user_info = "SELECT * FROM users WHERE user_id = $1";
	$stmt12 = pg_prepare($conn, "query_user_info", $sql_user_info);
	
	// Query USER login information
	$sql_user_login_info = "SELECT * FROM users
							WHERE user_id = $1 AND password = $2";
	$stmt2 = pg_prepare($conn, "query_user_login_info", $sql_user_login_info);
	
	// QUPDATE LAST ACCESS
	$sql_last_access = "UPDATE users SET last_access = $1 WHERE user_id = $2";
	$stmt3 = pg_prepare($conn, "update_last_access", $sql_last_access);
	
	// REGISTER SPECIFIC SQL
	$sql_create_user = "INSERT INTO users (user_id, password,user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access)
			VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9)";
	$stmt4 = pg_prepare($conn, "insert_user_registration", $sql_create_user);
	
	// PROFILE CREATE SQL
	$sql_create_profile = "INSERT INTO profiles (user_id, gender, gender_sought, body_type, city, images, headline, self_description, match_description, age, age_sought, music_genre, movie_genre, number_of_kids, kids_wanted, number_of_siblings, marital_status, number_of_pets, ethnicity)
			VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19)";
	$stmt5 = pg_prepare($conn, "insert_user_profile", $sql_create_profile);
	
	// UPDATE A USERS TYPE ('a', 'd', 'c', 'i')
	$sql_update_user_type = "UPDATE users SET user_type=$1 WHERE user_id=$2";
	$stmt6 = pg_prepare($conn, "update_user_type", $sql_update_user_type);
	
	// UPDATE USER PASSWORD
	$sql_update_password = "UPDATE users SET password=$1 WHERE user_id=$2";
	$stmt8 = pg_prepare($conn, "update_password", $sql_update_password);
	
	// SEARCH RESUlTS
	// Search based on criteria selected
	$sql_search_profiles = "SELECT * FROM profiles WHERE gender=$1";
	$stmt9 = pg_prepare($conn,"profile_search", $sql_search_profiles);
	
	// PASSWORD REQUEST
	$sql_pass_request = "SELECT * FROM users WHERE user_id=$1 AND email_address=$2";
	$stmt14 = pg_prepare($conn, "password_request", $sql_pass_request);
	
	// PROFILE IMAGE NUMBER
	$sql_profile_image = "SELECT images FROM profiles WHERE user_id=$1";
	$stmt15 = pg_prepare($conn, "profile_image_num", $sql_profile_image);
	
	// UPDATE IMAGE NUMBER
	$sql_image_update = "UPDATE profiles SET images=$1 WHERE user_id=$2";
	$stmt16 = pg_prepare($conn, "update_images", $sql_image_update);
	
	// UPDATE PROFILE INFORMATION
	$sql_profile_update = "UPDATE profiles SET gender=$1, gender_sought=$2, body_type=$3, city=$4, headline=$5, self_description=$6, match_description=$7, age=$8, age_sought=$9, music_genre=$10, movie_genre=$11, kids_wanted=$12, number_of_siblings=$13, marital_status=$14, ethnicity=$15 WHERE user_id=$16";
	$stmt17 = pg_prepare($conn, "profile_update", $sql_profile_update);
	
	// UPDATE USER INFORMATION
	$sql_user_update = "UPDATE users SET email_address=$1, first_name=$2, last_name=$3, birth_date=$4 WHERE user_id=$5";
    $stmt13 = pg_prepare($conn, "user_update", $sql_user_update);
	
	// QUERY MATCH INTEREST
	$sql_interested = "SELECT * FROM interests WHERE user_id=$1 AND interest_id=$2";
	$stmt18 = pg_prepare($conn, "query_interest", $sql_interested);
	
	// QUERY ALL INTERESTS USER SPECIFIC 
	$sql_all_interests = "SELECT * FROM interests WHERE user_id=$1";
	$stmt25 = pg_prepare($conn, "query_user_interests", $sql_all_interests);
	
	// QUERY INTERESTED IN YOU ONLY
	$sql_interested_in = "SELECT * FROM interests WHERE interest_id=$1";
	$stmt26 = pg_prepare($conn, "query_interested_in", $sql_interested_in);
	
	// QUERY SELECT OFFENSIVES
	$sql_offensive = "SELECT * FROM offensives WHERE reported_by=$1 AND offensive_user=$2";
	$stmt19 = pg_prepare($conn, "query_offensives", $sql_offensive);
	
	// QUERY REPORTED USERS (STATUS 'i')
	$sql_reported_users = "SELECT * FROM offensives WHERE status=$1";
	$stmt23 = pg_prepare($conn, "query_reported_users", $sql_reported_users);
	
	// INSERT OFFENSIVE USER
	$sql_report_offensive = "INSERT INTO offensives (reported_by, offensive_user, time_stamp, status) VALUES($1, $2, $3, $4)";
	$stmt20 = pg_prepare($conn, "insert_report_offensive", $sql_report_offensive);

	// INSERT INTEREST IN USER
	$sql_insert_interest = "INSERT INTO interests (user_id, interest_id, time_stamp) VALUES($1, $2, $3)";
	$stmt20 = pg_prepare($conn, "insert_interest", $sql_insert_interest);
	
	// REMOVE INTEREST IN USER
	$sql_remove_interest = "DELETE FROM interests WHERE user_id=$1 AND interest_id=$2";
	$stmt21 = pg_prepare($conn, "remove_interest", $sql_remove_interest);
	
	// QUERY USER TYPE
	$sql_user_type= "SELECT * FROM users WHERE user_type=$1";
	$stmt22 = pg_prepare($conn, "query_user_type", $sql_user_type);
	
	// QUERY USERS PROFILES BASED ON USER_TYPE
	$sql_disabled_profiles= "SELECT user_id FROM profiles WHERE user_id in (SELECT user_id FROM users WHERE user_type=$1)";
	$stmt24 = pg_prepare($conn, "query_profile_on_user_type", $sql_disabled_profiles);
	
function buildDropDown($table_name, $preselect = 0) {
	$conn = db_connect();
	$sql = "SELECT * FROM ".$table_name."";
	$result = pg_query($conn, $sql);
	$records = pg_num_rows($result);
		
	if (!$result)
	{
		echo "An error occurred with the query";
	}
	
	//generate the table
	$output = "";
	$output .= '<label for="'.$table_name.'">'.$table_name.'</label>';
	$output .= '<select id="'.$table_name.'" name="'.$table_name.'">';
	$output .= '<optgroup label="'.$table_name.'">';
	
	while($row=pg_fetch_assoc($result)){
		$selected = ($row['value'] == $preselect)? "selected":"";
		$output .= '<option '.$selected.' value="'.htmlspecialchars($row['value']).'">'.htmlspecialchars($row['property']).'</option>';
	}
	$output .= "</optgroup>";
	$output .= "</select>";
	echo $output;
}

function buildRadioButton($table_name, $preselect = 0) {
	$conn = db_connect();
	$sql = "SELECT * FROM ".$table_name."";
	$result = pg_query($conn, $sql);
	$records = pg_num_rows($result);
	
	if (!$result)
	{
		echo "An error occurred with the query";
	}
	
	$output = "";
	$output .= '<label for="'.$table_name.'">'.$table_name.'</label>';
	while($row=pg_fetch_assoc($result)){
		$selected = ($row['value'] == $preselect)? " checked=\"checked\"":"";
		$output .= '<input type=radio name="'.$table_name.'" id='.$row['value'].' value ='.$row['value'].' '.$selected.'/> <label for='.$row['value'].' class=light>'.$row['property'].'</label>&nbsp;&nbsp;';
	}
	
	echo $output;
	echo "<br/><br/>";
}

function buildCheckBox($table_name, $sum = 0) {
	$conn = db_connect();
	$sql = "SELECT * FROM ".$table_name."";
	$result = pg_query($conn, $sql);
	$records = pg_num_rows($result);
	
	if (!$result)
	{
		echo "An error occurred with the query";
	}
	$output = "";
	$output .= '<label for="'.$table_name.'[]">'.$table_name.'</label>';
	$i = 0;
	while($row=pg_fetch_assoc($result)){
		$selected = (isBitSet($i,$sum))? " checked=\"checked\"":"";
		$output .= '<input type=checkbox name="'.$table_name.'[]" id='.$row['value'].' value ='.$row['value'].' '.$selected.'/> <label for='.$row['value'].' class=light>'.$row['property'].'</label>&nbsp;&nbsp;';
		$i++;
	}
	
	echo $output;
	echo "<br/><br/>";
}


function getProperty($table, $value){
	$conn = db_connect();
	$sql = "SELECT property FROM " . $table . " WHERE value = " . $value;
	$results = pg_query($conn, $sql);
	$property = pg_fetch_result($results, 0, "property");
	
	/*if (!$property){
		echo "sql error occured";
	}*/
	//else {
    return $property;
	//}
}

/* 
	Author: Francis Hackenberger
	function build_search_sql
    builds the search sql for each checkbox list selected using the table name and $array of the checkbox[].
    includes the AND and OR clauses and returns the sql statement.
*/
function build_search_sql($table_name,$array){	
	if (count($array) == 1){
		$sql .= " AND profiles.".$table_name."=".reset($array);
	}
	else{
		$sql .= " AND (profiles.".$table_name."=".reset($array);
		array_shift($array);
		foreach($array as &$value){
			$value = " OR profiles.".$table_name."=".$value;
			$sql .= $value;
		}
		$sql .= ")";
	}
	return $sql;
}


function createProfilePreview($user_id){
	$conn = db_connect();
	$sql = "SELECT * FROM profiles WHERE user_id='$user_id'";
	$result = pg_query($conn, $sql);
	$profile = pg_fetch_assoc($result);
	if (count($profile) == 0){
		echo "sql error";
	}
	else{
		$description .= "I'm a ".getProperty(gender,$profile['gender']);
		$description .= " looking for a ".getProperty(gender_sought,$profile['gender_sought']);
		$description .= " preferably near ".getProperty(city,$profile['city']).". ";
		$description .= $profile['self_description'];
		$description .= "<br/><br/>Status: ".getProperty(marital_status, $profile['marital_status']);
		$output .= "<tr><td><a href='display_profile.php?id=".$user_id."'> <img src='./style/no_profile_image.jpg' alt='Match 1' width='150px'/></a></td><td>".$profile['user_id'] ."</td><td>".$description."</td></tr>";
	}
	return $output;
}
?>

