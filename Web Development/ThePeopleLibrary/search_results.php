<?php 
	// Francis Hackenberger - 100%
	$fileName = "search_results.php";
	$pageTitle = "Search Results"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "September 2015";
	$description = "This page is the results page to the dating website";	  
?>

<?php include('header.php');?>

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
	if (isset($_SESSION['matches'])) {
		// TO-DO: ADD PAGINATION
		$total_pages = ceil(count($_SESSION['matches'])/RECORDS_PER_PAGE_LIMIT);
		$total_matches = count($_SESSION['matches']);
		if (isset($_GET['page'])){
			$page = $_GET['page'];
		}
		else {
			$page = 1;
		}
		
		// if current page is greater than total pages...
		if ($page > $total_pages) {
		   // set current page to last page
		   $page = $total_pages;
		}
		// if current page is less than first page...
		if ($page < 1) {
		   // set current page to first page
		   $page = 1;
		} // end if


		$output = "";
		for($i = ($page - 1)*RECORDS_PER_PAGE_LIMIT;$i<$page*RECORDS_PER_PAGE_LIMIT && $i < $total_matches ;$i++)
		{
			$output .= createProfilePreview($_SESSION['matches'][$i+1]);
		}
			
		$paginate = pagination($page, $total_pages);
	}
	else{
		$_SESSION['user_message'] = "You must choose your search criteria before searching for profiles!";
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
	<h1>Found <?php echo $_SESSION['records'];?> Results</h1>
	<div class="center"><?php echo $paginate;?></div>
<table>
	<tr>
		<td colspan="7"><h5 style="margin: 0px;">Your Results</h5></td>
	</tr>
	<tr>
		<th style="width:150px"> Image </th>
		<th style="width:120px"> Matches </th>
		<th style="width:180px"> Description </th>
	</tr>
	<?php 		
		// GENERATE THE PROFILE PREVIEWS FOR ALL RECORDS FOUND
		echo $output;
	?>
</table>
	<div class="center"><?php echo $paginate;?></div>
<?php

?>

	
<?php include('footer.php');	?>