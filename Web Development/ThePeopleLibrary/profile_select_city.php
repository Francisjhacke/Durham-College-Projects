<?php 
// Author: Francis Hackenberger - 100%

$fileName="profile_select_city.php";
$date="October 2015";
$description="The purpose of this page is for a user to select a city they would like
					to start searching for matches in. The city will be required in order for users
					to begin searching for other profiles.";
$title="Profile Select City"; 
$banner="Profile Select City";
include("header.php"); ?>
<h2> <?php echo $banner; ?> </h2>


<?php 

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
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		$sumOfCities = $_COOKIE['search_cities'];
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$output = "";	// Clear the output variable
		
		// Store the number of cities selected in the array
		$cities = $_POST['city'];
	
		if ($cities){	
			// Get the sum of the cities selected from the array using the sumCheckBox function in the functions.php file
			$sumOfCities = sumCheckBox($cities);
			// Store the sumOfCities in the session and cookie
			$_SESSION['search']['cities'] = $sumOfCities;
			setcookie("search_cities", $sumOfCities, time() + EXPIRE_PERIOD); // Cookie exists for 30 days
		
			// Send the user to the profile search page
			header("Location:profile_search.php");
			ob_flush();
		}
		
		// They didn't select a city
		else{
			$output .= nl2br("You must select a city before continuing to the search page");
		}
		
		// Output any errors
		echo $output;
	}
}

else{
	$_SESSION['user_message'] = "Error occurred, try logging in again";
	header("Location:login.php");
	ob_flush();
}
?>

<img src="./style/DRTDurhamMap.png" alt="Durham Region Map" usemap="#DurhamRegionMap" class="image_map"/>
<map name="DurhamRegionMap" id="DurhamRegionMap">
	<!-- Toronto -->
    <area alt="Toronto" title="Toronto" target='_self' href="profile_search.php?city=128" shape="poly" coords="9,149,84,129,112,244,39,263" />
    <!-- Pickering -->
	<area alt="Pickering" title="Pickering" href="profile_search.php?city=16" shape="poly" coords="39,262,115,245,126,287,93,293,90,296,95,301,93,313,99,321,103,327,104,335,98,341,87,333,82,335,79,344,73,344,64,341,59,337,56,335" />
	<!-- Ajax -->
    <area alt="Ajax" title="Ajax" href="profile_search.php?city=8" shape="poly" coords="92,296,123,290,135,326,123,329,115,335,107,335,95,313" />
	<!-- Whitby -->
    <area alt="Whitby" title="Whitby" href="profile_search.php?city=2" shape="poly" coords="115,247,154,236,176,314,167,318,156,314,148,317,137,322" />
    <!-- Oshawa -->
	<area alt="Oshawa" title="Oshawa" href="profile_search.php?city=1" shape="poly" <area alt="" title="" href="#" shape="poly" coords="154,236,190,228,212,306,202,306,176,314" />
    <!-- Bowmanville -->
	<area alt="Bowmanville" title="Bowmanville" href="profile_search.php?city=4" shape="poly" coords="193,231,266,212,269,217,344,195,370,281,213,305" />
    <!-- Uxbridge -->
	<area alt="Uxbridge" title="Uxbridge" href="profile_search.php?city=32" shape="poly" coords="72,90,86,67,91,47,108,14,131,14,167,146,95,162" />
    <!-- Port Perry -->
	<area alt="Port Perry" title="Port Perry" href="profile_search.php?city=64" shape="poly" coords="95,162,167,146,187,226,114,241" />
	<area alt="Port Perry" title="Port Perry" href="profile_search.php?city=64" shape="poly" coords="179,177,190,151,206,149,198,187,201,224,192,230" />
	<area alt="Port Perry" title="Port Perry" href="profile_search.php?city=64" shape="poly" coords="198,187,209,222,263,207,246,146" />
</map>


<!-- Build the check box -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
<fieldset>  
	<input type="checkbox"  id="city_toggle" onclick="cityToggleAll();" name="city[]" value="0">Select all
	<br/>	
	<br/>
	<?php buildCheckBox("city", $sumOfCities); ?>
	<input type="submit" value="Continue to search page">
</fieldset>
</form>
	
<script type="text/javascript">
	function cityToggleAll()
	{
		//alert("In cityToggleAll()");  //alerts used for de-bugging
		var isChecked = document.getElementById("city_toggle").checked;
		var city_checkboxes = document.getElementsByName("city[]");
		for (var i in city_checkboxes){
		//SAME AS for ( i = 0; i < city_checkboxes.length; i++){
			city_checkboxes[i].checked = isChecked;
		}		
	}
	
//-->
</script>

<?php include("footer.php"); ?>