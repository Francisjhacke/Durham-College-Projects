<!-- Francis Hackenberger, Daniel Oscar-Few, Evan Ly, Sam Chard, Antonio Franca -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- design from HTML5webtemplates.co.uk -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="./style/style.css" title="style" />

<?php
//4error_reporting(E_ALL);
//ini_set('display_errors', true);
// REQUIRED INCLUDES FOR WEBSITE FUNCTIONALITY
require_once './includes/functions.php'; 
require_once './includes/constants.php';
require_once './includes/db.php';
ob_start();


// Check if a session has started. If not, then start one
if(session_id() =="")
{
	session_start();
}
?>
	<!--
	Author: Group 20 (Francis Hackenberger, Daniel Oscar-Few, Evan Ly, Sam Chard, Antonio Franca)
	Filename: <?php echo $fileName ?>
	Date: <?php echo $date ?>
	Description: <?php echo $description ?>
	-->
	
  <title>People Library</title>
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
		
          <h1><a href="index.php">People<span class="logo_colour">Library</span></a></h1>
          <h2>Don't judge a book by its cover</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
			<?php 
			echo "<li><a href='index.php'>Index</a></li>";
			
			if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == CLIENT){
				echo "<li><a href='dashboard.php'>Dashboard</a></li>";
				echo "<li><a href='profile_images.php'>Profile Pictures</a></li>";
			    echo "<li><a href='profile_search.php'>Profile Search</a></li>";
				echo "<li><a href='interests.php'>Interests</a></li>";
				echo "<li><a href='logout.php'>Logout</a></li>";
			}
			elseif (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == INCOMPLETE_CLIENT){
				echo "<li><a href='dashboard.php'>Dashboard</a></li>";
				echo "<li><a href='create_profile.php'>Create Profile</a></li>";
				echo "<li><a href='logout.php'>Logout</a></li>";
			}
			elseif (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == ADMIN){
				echo "<li><a href='admin.php'>Dashboard</a></li>";
				echo "<li><a href='disabled_users.php'>Disabled Users</a></li>";
				echo "<li><a href='logout.php'>Logout</a></li>";
			}
			elseif (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == DISABLED_CLIENT){
				echo "<li><a href='logout.php'>Logout</a></li>";
			}
			else{
				echo "<li><a href='register.php'>Register</a></li>";
				echo "<li><a href='login.php'>Login</a></li>";	
			}
			?>
        </ul>
      </div>
    </div>
      <div id="content">
	  