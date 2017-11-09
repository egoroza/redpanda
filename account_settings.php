<?php

include "session.php";
include "menu.php";
$changepw = @$_POST['changepw'];
$changemail = @$_POST['changemail'];

$oldpw = mysqli_real_escape_string($con, @$_POST['oldpw']);
$newpw = mysqli_real_escape_string($con, @$_POST['newpw']);
$newpw2 = mysqli_real_escape_string($con, @$_POST['newpw2']);
$oldemail = mysqli_real_escape_string($con, @$_POST['oldemail']);
$newemail = mysqli_real_escape_string($con, @$_POST['newemail']);
$newemail = mysqli_real_escape_string($con, @$_POST['newemail']);



?>

<div class = "content">
<h1>Account Settings</h1>
<p>Welcome to your account settings page. Here you can change your password, alter privacy settings, and more. For assistance, please contact <a href = "mailto:support@cuteaspixels.com">support@cuteaspixels.com</a>.</p>
<center>
<p style = "color: red;">
<?php
	if($changepw){
		if($oldpw&&$newpw&&$newpw2){
			if(md5($oldpw) == $pass){ 
				if($newpw == $newpw2){
					$newpw = md5($newpw);
					$sql = "UPDATE users SET password='$newpw' WHERE email='$user_check'";
					if(mysqli_query($con, $sql)) echo "Your password has been changed.";
					else echo "Looks like we're experiencing some technical difficulties. Please try again.";
				}
				else echo "New passwords do not match.";
			}
			else echo "Sorry, incorrect current password. Please try again.";
		}
		else echo "Please fill out all of the fields to continue.";
	}
	
	
	if($changemail){
		if($oldemail&&$newemail&&$newemail2){
			if($oldemail == $user_check){
				if(!preg_match("~[A-Za-z0-9._-]*@[A-Za-z0-9._-]*.[A-Za-z0-9]~", $newemail)){ // Check e-mail format
					if($newemail == $newemail2){
						$sql = "UPDATE users SET email='$newemail' WHERE email='$user_check'";
						if(mysqli_query($con, $sql)) echo "Your e-mail has been changed.";
						else echo "Looks like we're experiencing some technical difficulties. Please try again.";
					}
					else echo "New e-mails do not match.";
				}
				else echo "Sorry, that is not a valid e-mail address.";
			}
			else echo "Sorry, your current e-mail address doesn't match the one we have on file. Please try again.";
		}
		else echo "Please fill out all of the fields to continue.";
	}
	
?>
</p>
<table style = "text-align:center;">
<tr>
<td>
<h2>Change Password</h2>

<form action = "#" method = "POST">
<input type = "password" name = "oldpw" id = "oldpw" size = "32" placeholder = "Current Password"><br>
<input type = "password" name = "newpw" id = "newpw" size = "32" placeholder = "New Password"><br>
<input type = "password" name = "newpw2" id = "newpw2" size = "32" placeholder = "Confirm Password"><br>
<input type = "submit" name = "changepw" id = "changepw" value = "Change">
</form>
</td>
<td>
<h2>Change E-mail</h2>
<form action = "#" method = "POST">
<input type = "text" name = "oldemail" id = "oldemail" size = "32" placeholder = "Current E-mail"><br>
<input type = "text" name = "newemail" id = "newemail" size = "32" placeholder = "New E-mail"><br>
<input type = "text" name = "newemail2" id = "newemail2" size = "32" placeholder = "Confirm E-mail"><br>
<input type = "submit" name = "changemail" id = "changemail" value = "Change">
</form>
</td>
</tr>
</table>
</center>
</div>