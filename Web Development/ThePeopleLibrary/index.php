<!-- DECLARATIONS -->
<?php 
	$fileName = "index.php";
	$pageTitle = "Main Page"; 
	$banner = "WEDE 3201 - Web Development II";
	$date = "";
	$description = "This page is the index page to the dating website";	  
?>

<?php include 'header.php';?>	

        <!-- insert the page content here -->
		
		<div id="index_main">
			<div id="index_welcome">
				<img class="connect_pic" src="./style/couple.jpg" alt="Couple"/>
				<h2> Welcome! </h2>
				<p>Welcome to the People Library online dating service. Choose 
				People Library to give you the peace of mind in knowing that you will find that special someone in search
				of something more than just true love with the help of our innovative matching technology. </p>
			</div>
			<br/>
			<div id="index_connect">
				<h2> Connect </h2>
				<p>People Library connects you with people who are passionate
				about something that you can relate to and make your time meaningful.
				Signing up with People Library will help you match up with quality 
				results that will give you access to communicate and start dating right away.</p>
			</div>
			<br/>
			<div id="index_how">
				<h2> How? </h2>
				<p>It is really simple, start off by registering an account, then make your profile by completing the
				questions with information about yourself and what you're looking for.
				Finally, search for other registered accounts by tweaking the search options, or leave the rest to us to find your perfect matches!</p>
			</div>
			<div id="index_about">
				<h2> About Us </h2>
				<p>The People Library team (Group 20) created this dating website for our WEDE 3201 course
				   at Durham College as part of our group project deliverables. The website is hosted on the
				   Opentech2.durhamcollege.org server and will be updated following our course curriculum. 
				   As the course progresses, our website will become more functional and interactive.</p>
				   <div id="signature">
					<p> - Francis Hackenberger, Daniel Oscar-Few, Sam Chard, Evan Ly, Franca Antonio</p>
				   </div>
			</div>
			<br/>
		</div>
	  
<?php include 'footer.php';?>

