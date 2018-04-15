<!-- DECLARATIONS -->
<?php 
	// Author: Francis Hackenberger - 100%
	$fileName = "profile_images.php";
	$pageTitle = "Profile Images"; 
	$banner = "Profile Images";
	$date = "2015-11-10";
	$description = "The purpose of this page is for users to view and
					upload their profile pictures. Additionally, they will
					have the option to delete an image or multiple images as well
					as select their main image.";	  
?>

<?php include 'header.php';?>	

<?php 
if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == CLIENT){	
	// Declarations
	$user_id = $_SESSION['user']['user_id'];
	$upload_directory = "./profiles/".$user_id;
	$conn = db_connect();
	$myLogin = array($user_id);
	$result = pg_execute($conn, "profile_image_num", $myLogin);
	$images = pg_fetch_result($result, 0, 0);
	
	$allowed_types=array('image/jpeg','image/jpg','image/pjpeg');
	// Display images		
	if ($images){
		for($counter = 1; $counter <= $images; $counter++){
			$selected = ($counter == 1)?" checked=\"checked\"":"";
			$profile_images .= '<br/><br/><img src="'.$upload_directory.'/'.$user_id."-".$counter.'" class="profile_img" alt="'.$user_id.'"-"'.$counter.'"/>';
			$profile_images .= '<br/><br/> <input type="checkbox" name="delete[]" value="'.$counter.'">Delete';
			$profile_images .= '<br/><br/> <input type="radio" name="main_image" id="'.$counter.'" value="'.$counter.'" '.$selected.'>Main image';
		}			
	}	
	echo "Images: " . $images;
	//recursiveDelete($upload_directory);
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		// IMAGE UPLOAD
		if($_POST['upload']){
			if ($images < MAXIMUM_PROFILE_IMAGES){
				if(isset($_FILES["uploadfile"])){
					
				/*	echo "<pre>";
					print_r($_FILES);
					echo "</pre>";*/
					
					// FILE UPLOAD VALIDATION
					if ($_FILES['uploadfile']['size'] > FILE_UPLOAD_LIMIT){
						$error .= "File selected is too large. Image must be under ". round(FILE_UPLOAD_LIMIT / 1024) . "kb<br/>";
					}
					elseif(!in_array($_FILES['uploadfile']['type'], $allowed_types)){
						$error .= "<br/>File must be of type JPEG.<br/>";
					}
					elseif($_FILES['uploadfile']['error'] != 0){
						$error .= "Error: ".$_FILES['upload']['error'];
					}
					// No problems detected
					else{
						// check if a directory exists
						if (!is_dir($upload_directory)){
							mkdir($upload_directory, 0777, true);	
						}						
						// Get the new number of images
						$new_image_num = $images+1;
						$target_file = $upload_directory."/".$user_id."-".$new_image_num;
						
						if (move_uploaded_file($_FILES['uploadfile']['tmp_name'],$target_file)){
							// Update the profiles table with the new images number
							$image_info = array($new_image_num,$user_id);
							$result = pg_execute($conn, "update_images", $image_info);
							echo "<br/>Image successfully uploaded!";
							
							// Re-updated the images shown
							$result = pg_execute($conn, "profile_image_num", $myLogin);
							$images = pg_fetch_result($result, 0, 0);
							$profile_images = "";	
							if ($images){
								for($counter = 1; $counter <= $images; $counter++){
									$selected = ($counter == 1)?" checked=\"checked\"":"";
									$profile_images .= '<br/><br/><img src="'.$upload_directory.'/'.$user_id."-".$counter.'" class="profile_img" alt="'.$user_id.'"-"'.$counter.'"/>';
									$profile_images .= '<br/><br/> <input type="checkbox" name="delete[]" value="'.$counter.'">Delete';
									$profile_images .= '<br/><br/> <input type="radio" name="main_image" id="'.$counter.'" value="'.$counter.'" '.$selected.'>Main image';
								}			
							}	
						}
						else{ 
							echo "<br/><br/>Failed to upload";
						}
					}	
				}
				else{
					$error .= "<br/>No file selected";
				}
			}
			else {
				$error .= "<br/><br/>You may only have " . MAXIMUM_PROFILE_IMAGES . " images. Please remove an image before uploading another.";
			}
		}
		
		// IMAGE DELETE
		
		
		if($_POST['delete_img']){	
			if ($images){
				if (!empty($_POST['delete'])){
					$delete = $_POST['delete'];
					for ($i =(count($delete) - 1); $i >= 0; $i--){
						// Determine the images to be deleted
						$images_to_delete = "profiles/".$user_id."/".$user_id."-".$delete[$i];
						
						// Delete the images
						echo "Deleting image: " . $i+1;
						recursiveDelete($images_to_delete);
						$new_images_num = $images-1;
						
						// Update the database
						$image_info = array($new_images_num, $user_id);
						$result = pg_execute($conn, "update_images", $image_info);
						
						// Re-updated the images shown
						$result = pg_execute($conn, "profile_image_num", $myLogin);
						$images = pg_fetch_result($result, 0, 0);
						$profile_images = "";	
						if ($images){
							for($counter = 1; $counter <= $images; $counter++){
								$selected = ($counter == 1)?" checked=\"checked\"":"";
								$profile_images .= '<br/><br/><img src="'.$upload_directory.'/'.$user_id."-".$counter.'" class="profile_img" alt="'.$user_id.'"-"'.$counter.'"/>';
								$profile_images .= '<br/><br/> <input type="checkbox" name="delete[]" value="'.$counter.'">Delete';
								$profile_images .= '<br/><br/> <input type="radio" name="main_image" id="'.$counter.'" value="'.$counter.'" '.$selected.'>Main image';
							}			
						}	
						// If the new image number is 0 (no images left in the directory)
						if ($new_images_num == 0){
							recursiveDelete($upload_directory);		// Delete the directory
						}
						else{
							for ($j = $delete[$i]; $j <= $images; $j++){
								// Rename the files
								rename($upload_directory."/".$user_id."-".$delete[$i], "profiles/".$user_id."/".$user_id."-".$j+1);
							}
						}
					}
				}	
				else{
					$error .= "<br/><br/>You must select an image to delete.";
				}
			}	
			else{
				echo "<br/><br/>There are no images to delete";
			}	
		}
		
		if ($_POST['save']){
			// Make the selected radio button the main image
			// Get the selected images number
			$new_main_image_num = $_POST['main_image'];
			// Get the old main images number
			$old_main_image = $upload_directory."/".$user_id."-1";
			// Set the new main image
			$new_main_image = $upload_directory."/".$user_id."-".$new_main_image_num;
			
			// Change the old main image to a temporary name
			rename($old_main_image, $upload_directory."/tmp_old_main_img");
			// Change the new main image to image #1
			rename($new_main_image, $old_main_image);
			// Change the old main image from the temporary name back to the new main image that was changed
			rename($upload_directory."/tmp_old_main_img", $new_main_image);
			
			// Re-updated the images shown
			$result = pg_execute($conn, "profile_image_num", $myLogin);
			$images = pg_fetch_result($result, 0, 0);
			$profile_images = "";	
			if ($images){
				for($counter = 1; $counter <= $images; $counter++){
					$selected = ($counter == 1)?" checked=\"checked\"":"";
					$profile_images .= '<br/><br/><img src="'.$upload_directory.'/'.$user_id."-".$counter.'" class="profile_img" alt="'.$user_id.'"-"'.$counter.'"/>';
					$profile_images .= '<br/><br/> <input type="checkbox" name="delete[]" value="'.$counter.'">Delete';
					$profile_images .= '<br/><br/> <input type="radio" name="main_image" id="'.$counter.'" value="'.$counter.'" '.$selected.'>Main image';
				}			
			}	
		}
	} // End of POST
}
elseif ($_SESSION['user']['user_type'] == INCOMPLETE_CLIENT) {
		header("Location:create_profile.php");
		ob_flush();
}

else{
	header("Location:login.php");
	ob_flush();
}
?>

<h2>Profile Images</h2>
<?php 
	echo $error; 
?>
<br/>
<br/>
<br/>
<form id="uploadform" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div id="profile_images">
		<?php
			echo $profile_images;
		?>
	</div>
	<br/>
	<strong> Select image to upload: </strong>
	<input name="uploadfile" type="file" id="uploadfile" />
	<input type="submit" value="Upload" name="upload" />
	<input type="submit" value="Delete" name="delete_img" />
	<input type="submit" value="Save" name="save" />
</form>
<br/>
			
<?php include 'footer.php';?>

