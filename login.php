<?php

$con = mysqli_connect("localhost", "egoroza_admin", "ChocolateCh!p2@0", "egoroza_panda");

if($con == false) die("ERROR: Could not connect" . mysqli_connect_error());

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

	$u_login = mysqli_real_escape_string($link, $_POST['user_login']);
	$p_login = mysqli_real_escape_string($link, $_POST['pass_login']);
	$p_login = md5($p_login);
	$check = false;

	$sql = "SELECT id FROM users WHERE email = '$u_login' and password = '$p_login'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);
	if($count == 1){
		
		header("Location: home.php");
		//session_register("u_login");
		$_SESSION['login_user'] = $u_login;
		
	}
	else{
		$check = true;
		//echo "Bad e-mail/password.";
	}

}


?>

<html>
<div id = "loginModal" class = "modalDialog">
<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Login</h2>

Already a member? Login below.<br>
<?php
	$log = @$_POST['login'];
	if($log){
		if($check == true) echo '<p style = "color: red;">Bad email/password! Please try again.</p>';
	}
?>
<form action = "index.php#loginModal" method = "POST">
<input type = "text" name = "user_login" placeholder = "E-mail Address"> <br><input type = "password" name = "pass_login" placeholder = "Password"><br>
	<input type = "submit" name = "login" value = "Log Me In!">
</form>
</div>
</div>
</html>