<?php
   include ("./inc/connect.inc.php");
   session_start();
   global $user_check;
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($con,"select email from users where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];

   
   		global $userid;
		global $firstname;
		global $lastname;
		global $activated;
		global $pass;
		$sql = mysqli_query($con, "SELECT first_name, last_name, id, activated, password FROM users WHERE email='$user_check'");
		
		if(mysqli_num_rows($sql) == 1){
			$get = mysqli_fetch_assoc($sql);
			$firstname = $get['first_name'];
			$lastname = $get['last_name'];
			$userid = $get['id'];
			$activated = $get['activated'];
			$pass = $get['password'];
		}
   
   if(!isset($_SESSION['login_user'])){
      header("Location: index.php");
   }
   
?>