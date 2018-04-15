<?php 
	// Francis Hackenberger - 100%
	$fileName = "disabled_users.php";
	$pageTitle = "Disabled Users"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "December 2015";
	$description = "The purpose of this page is to display the disabled users on the website. For admins only";	  
?>

<?php include('header.php');?>

<?php

if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == ADMIN) {
	
	// RETRIEVE DISABLED USERS FROM DATABASE
	$conn = db_connect();
	$disabled_user_type = array(DISABLED_CLIENT);
	$result = pg_execute($conn, "query_profile_on_user_type", $disabled_user_type);
	
	$_SESSION['count'] = 1;
	// Load matches in an a session variable (array)
	while ($row = pg_fetch_assoc($result)){
		$_SESSION['disabled'][$_SESSION['count']] = $row['user_id'];
		$_SESSION['count'] = $_SESSION['count'] + 1;
	}
	
	$records_found = count($_SESSION['disabled']);
	
	$total_pages = ceil(count($_SESSION['disabled'])/RECORDS_PER_PAGE_LIMIT);
	// Change to count records of disabled users returned
	$total_matches = count($_SESSION['disabled']);
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

	print_r($disabled_user_info);
	$output = "";
	for($i = ($page - 1)*RECORDS_PER_PAGE_LIMIT;$i<$page*RECORDS_PER_PAGE_LIMIT && $i < $total_matches ;$i++)
	{
		$output .= createProfilePreview($_SESSION['disabled'][$i+1]);
	}
		
	$paginate = Disabledpagination($page, $total_pages);
}

else{
	//$_SESSION['user_message'] = "Error occurred, try logging in again";
	//header("Location:login.php");
	//ob_flush();
}
?>
	<h1>Found <?php echo $records_found; ?> Disabled Users</h1>
	<div class="center"><?php echo $paginate;?></div>
<table>
	<tr>
		<td colspan="7"><h5 style="margin: 0px;">Disabled Users</h5></td>
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