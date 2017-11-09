

<html>
<body>
<?php include ("./inc/header.inc.php");?>

<body>

<center>
<table style = "width:60%;">
<tr>
<td>
<img src = "/img/pandaimg.png">
</td>
<td>
<?php
	include ("./inc/connect.inc.php");
	
	$email = $_GET['email'];
	$hash = $_GET['hash'];
	
	if(isset($email) && isset($hash)){
    // Verify data
    	$email = mysqli_escape_string($con, $_GET['email']); // Set email variable
    	$hash = mysqli_escape_string($con, $_GET['hash']); // Set hash variable
                 
    	$search = mysqli_query($con, "SELECT email, hash, activated FROM users WHERE email='$email' AND hash='$hash' AND activated='0'") or die(mysql_error()); 
    	$match  = mysqli_num_rows($search);
                 
   		if($match > 0){
        	// We have a match, activate the account
        		mysqli_query($con, "UPDATE users SET activated='1' WHERE email='$email' AND hash='$hash' AND activated='0'") or die(mysql_error());
        		echo "Woohoo! Your e-mail address has been verified.";
    		}
    		else{
        // No match -> invalid url or account has already been activated.
       			echo "Invalid URL or your account is already activated!";
    		}
                 
	}
	
	else{
    // Invalid approach
    		echo "Invalid approach, please use the link that has been sent to your email.";
	}
?>
</body>
</html>