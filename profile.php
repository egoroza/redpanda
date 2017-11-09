<?php

include ("./inc/connect.inc.php");
include ("session.php");

if (isset($_GET['id'])){
	$id = mysqli_real_escape_string($con, $_GET['id']);
	$real = true;
	if(ctype_alnum($id)) {
		$sql = mysqli_query($con, "SELECT first_name, last_name, sign_up_date FROM users WHERE id='$id'");
		if(mysqli_num_rows($sql) == 1){
			$get = mysqli_fetch_assoc($sql);
			$firstname = $get['first_name'];
			$lastname = $get['last_name'];
			$joined = $get['sign_up_date'];
		}
		else{
			$real = false;
		}
	}
}

?>

<?php include ('menu.php'); ?>
<div class = "content">
<center>
<img src = "http://redpanda.cuteaspixels.com/img/TempPenguin.png" style = "height:200px;width:200px;float:left;padding:15px;" id = "profile_pic">
<h1><?php 
if($real == true)echo "$firstname $lastname";
else echo "User Does Not Exist";
?></h1>

<?php  
if($real == true){
	echo "Member since $joined<br><br><a href = '/settings/upload_avatar.php'>Change My Profile Picture</a> | <a href = '/settings/edit_bio.php'> Edit My Bio</a>";
	include ('send_post.php');
	include ('user_posts.php');
	}
?>
</center>

</div>
