<?php
	include ('session.php');
?>

<?php
		global $userid;
		global $firstname;
		global $lastname;
		$sql = mysqli_query($con, "SELECT first_name, last_name, id FROM users WHERE email='$user_check'");
		if(mysqli_num_rows($sql) == 1){
			$get = mysqli_fetch_assoc($sql);
			$firstname = $get['first_name'];
			$lastname = $get['last_name'];
			$userid = $get['id'];
		}
		
		
?>

<html>
<body>
<?php include ('menu.php'); ?>

<div class = "content">
<h1>Welcome, <?php echo "$firstname $lastname";?>!</h1>
<?php

$sql = mysqli_query($con, "SELECT activated FROM users WHERE email = '$user_check'");

if(mysqli_num_rows($sql) == 1){
	$get = mysqli_fetch_assoc($sql);
	if($get['activated'] == 0) echo "
	
	Hi $firstname!<br>
	<br>
	It looks like your account hasn't been activated yet! We sent an e-mail to <b>$user_check</b>. Please verify your e-mail to enjoy all of the fun features that
	Red Panda Town has to offer! 
	
	
	";
}

?>
<br><br>

<?php include ('send_post.php');?>
<?php include ('user_posts.php');?>
</div>

</body>
</html>