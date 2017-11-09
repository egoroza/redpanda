<?php
$link = mysqli_connect("localhost", "egoroza_admin", "ChocolateCh!p2@0", "egoroza_panda");

if($link == false) die("ERROR: Could not connect" . mysqli_connect_error());
	session_start();
   if(isset($_SESSION['login_user'])){
      header("Location: home.php");
   }

$reg = @$_POST['reg'];
$fn = ""; 
$ln = ""; 
$em = "";
$pswd = ""; 
$pswd2 = "";
$d = "";
$e_check = "";
$subject = "";
$message = "";
$headers = "";

$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$em = strip_tags(@$_POST['email']);
$pswd = strip_tags(@$_POST['pass']);
$pswd2 = strip_tags(@$_POST['pass2']);
$d = date("Y-m-d");
	
if ($reg){

$query = mysqli_query($link, "SELECT email FROM users WHERE email='$em'");
if (!($query && $query->num_rows)) {
	if($fn&&$ln&&$em&&$pswd&&$pswd2) {
		
		if($pswd == $pswd2){
			if(strlen($pswd) > 20 || strlen($pswd) < 6){
				echo "Password must be between 6 and 20 characters long.";
			}

			if(!preg_match("~[A-Za-z0-9._-]*@[A-Za-z0-9._-]*.[A-Za-z0-9]~", $em)) {
			echo "Not a valid e-mail address.";
			}
			
			else{
				$pswd = md5($pswd);
				$pswd2 = md5($pswd2);
				$hash = md5(rand(0,1000));
				
				$query = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `sign_up_date`, `activated`, `hash`) VALUES ('', '$fn', '$ln', '$em', '$pswd', '$d', '0', '$hash')";
				
				if (mysqli_query($link, $query)){
					

// the message
$msg = "

<html>
<center>
<img src = 'http://redpanda.cuteaspixels.com/img/logo.png'>
<p style = 'font-family: Georgia; font-size: 20px;'>
Hi $fn $ln, thanks for joining Panda Town! Just one more step: please confirm your e-mail address.<br>
Just click the link below:<br><br>
<a href = 'http://www.redpanda.cuteaspixels.com/verify.php?email=$em&hash=$hash' style = 'text-decoration:none; color: #8B0C0C'>http://www.redpanda.cuteaspixels.com/verify.php?email=$em&hash=$hash</a><br><br>
That's it! Hope to see you soon!<br><br>
- Red Panda Town Staff
</p>
</center>
</html>

";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);
 $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'From: Red Panda Town <emiry@cuteaspixels.com>' . "\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

					
					if(mail($em,"Welcome to Red Panda Town! Please verify your e-mail address.",$msg,$headers)){
						header("Location: complete_signup.php");
						//die("<h1>Thanks for signing up to Red Panda Town!</h1> Please check your email for an activation link.");	
					}
					else die("Mail was not delivered!");
				}
				else die("<h1>DATABASE ERROR</h1>");
			}
			
		}
		else {
			echo "Passwords do not match.";
		}
	}
	else{
		echo "Please fill in all of the fields.";
	}
}

else{
	echo "It looks like you already have an account registered with this e-mail address.";
}

}

?>
<?php include 'login.php';?>
<?php include ("./inc/header.inc.php");?>

<body>

<center>
<table style = "width:60%;">
<tr>
<td>
<img src = "/img/pandaimg.png">
</td>
<td>
A place to connect with all of your furry friends! <br>Sign up today or <a href = "#loginModal">login</a>.<br><br>
<form action = "index.php" method = "POST">
<table style = "margin-left:auto;margin-right:auto;width:25%;border:none;">
<tr>
    <td><input type="text" name="fname" placeholder = "First Name"></td> 
  </tr>
<tr>
    <td><input type="text" name="lname" placeholder = "Last Name"></td> 
  </tr>
<tr>
    <td><input type="text" name="email" placeholder = "E-mail"></td> 
  </tr>
<tr>
<tr>
    <td><input type="password" name="pass" placeholder = "Choose a Password"></td> 
  </tr>
<tr>
    <td><input type="password" name="pass2" placeholder = "Confirm Password"></td> 
  </tr>  
</table>
<center><input type="submit" name = "reg" value="Sign Me Up!"></center>
</form>
</td>
</tr>
</table>
</center>

<br><br>


</body>