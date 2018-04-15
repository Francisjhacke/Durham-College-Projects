<?php
function DisplayCopyright()
{
	$copyright = "Group 20 &copy;";
	$copyright .= date('Y');
	Return $copyright;
}	

function calculateAge($date) {
	$current = date("Ymd");
	$date = date("Ymd", strtotime($date));
	$age = (($current - $date) / 10000);
	return $age;
}

function generateRandomNumber($minimum,$maximum){
	$random_value = mt_rand($minimum,$maximum);
	return $random_value;
}

function generateRandomSelection($minimum,$maximum){
	$random_value = mt_rand($minimum,$maximum);
	return $random_value;
}

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}

function generateRandomDate($start_date, $end_date)
{
    // Convert to timetamps
    $min = strtotime($start_date);
    $max = strtotime($end_date);

    // Generate random number using above bounds
    $val = rand($min, $max);

    // Convert back to desired date format
    return date('Y-m-d', $val);
}

/*
	this function should be passed a integer power of 2, and any 
	decimal number,	it will return true (1) if the power of 2 is 
	contain as part of the decimal argument
*/
function isBitSet($power, $decimal) {
	if((pow(2,$power)) & ($decimal)) 
		return 1;
	else
		return 0;
} 

/*
	this function can be passed an array of numbers 
	(like those submitted as part of a named[] check 
	box array in the $_POST array).
*/
function sumCheckBox($array)
{
	$num_checks = count($array); 
	$sum = 0;
	for ($i = 0; $i < $num_checks; $i++)
	{
	  $sum += $array[$i]; 
	}
	return $sum;
}

function pagination($page, $total_pages){
	if ($total_pages > 1){
	// if not on page 1, don't show back links
	if ($page > 1) {
	   // show << link to go back to page 1
	   $output .= " <a href='search_results.php?page=1'><<</a> ";
	   // get previous page num
	   $prevpage = $page - 1;
	   // show < link to go back to 1 page
	   $output .= " <a href='search_results.php?page=$prevpage'><</a> ";
	}

	// loop to show links to range of pages around current page
	for ($x = ($page - PAGE_NUM_RANGE); $x < (($page + PAGE_NUM_RANGE) + 1); $x++) {
	   // if it's a valid page number
	   if (($x > 0) && ($x <= $total_pages)) {
		  // if we're on current page
		  if ($x == $page) {
			 // 'highlight' it but don't make a link
			 $output .= " [<b>$x</b>] ";
		  // if not current page
		  } else {
			 // make it a link
			 $output .= " <a href='search_results.php?page=$x'>$x</a> ";
		  }
	   }
	}
					 
	// if not on last page, show forward and last page links        
	if ($page != $total_pages) {
	   // get next page
	   $nextpage = $page + 1;
		// echo forward link for next page 
	   $output .= " <a href='search_results.php?page=$nextpage'>></a> ";
	   // echo forward link for last page
	   $output .= " <a href='search_results.php?page=$total_pages'>>></a> ";
	} 
	return $output;
	}
}

function Disabledpagination($page, $total_pages){
	if ($total_pages > 1){
	// if not on page 1, don't show back links
	if ($page > 1) {
	   // show << link to go back to page 1
	   $output .= " <a href='disabled_users.php?page=1'><<</a> ";
	   // get previous page num
	   $prevpage = $page - 1;
	   // show < link to go back to 1 page
	   $output .= " <a href='disabled_users.php?page=$prevpage'><</a> ";
	}

	// loop to show links to range of pages around current page
	for ($x = ($page - PAGE_NUM_RANGE); $x < (($page + PAGE_NUM_RANGE) + 1); $x++) {
	   // if it's a valid page number
	   if (($x > 0) && ($x <= $total_pages)) {
		  // if we're on current page
		  if ($x == $page) {
			 // 'highlight' it but don't make a link
			 $output .= " [<b>$x</b>] ";
		  // if not current page
		  } else {
			 // make it a link
			 $output .= " <a href='disabled_users.php?page=$x'>$x</a> ";
		  }
	   }
	}
					 
	// if not on last page, show forward and last page links        
	if ($page != $total_pages) {
	   // get next page
	   $nextpage = $page + 1;
		// echo forward link for next page 
	   $output .= " <a href='disabled_users.php?page=$nextpage'>></a> ";
	   // echo forward link for last page
	   $output .= " <a href='disabled_users.php?page=$total_pages'>>></a> ";
	} 
	return $output;
	}
}



function recursiveDelete($target) {
	if (!file_exists($target)){ //no target, implies nothing to delete, function is done
		return true;
	}
	if (!is_dir($target)) {  //target is a file, not a directory, delete it with unlink() function
		return unlink($target); //will return false is Apache does not have write permissions in $target
	}
	
	$directoryContents = scandir($target); //target is a directory, get a list of files and directories inside the specified path as an array
	
	foreach ($directoryContents as $file) { //loop through the target's files and sub-directories
		echo "<br/>File/folder to be deleted: " . $file;
		if ($file == '..' || $file == '.') { //ignore parent and current diectories in file listing
			continue;
		}
		if (!recursiveDelete($target. "/" . $file)) {  //delete items, and sub-directories recursively
			return false;
		}
	}
	return rmdir($target); //delete the original target, now empty
}



?>