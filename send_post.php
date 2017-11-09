<?php
include ("./inc/connect.inc.php");

date_default_timezone_set('US/Eastern');

$send = @$_POST['send'];

global $author;

if($send) {
	$msg = strip_tags(@$_POST['pst']);
	$msg = mysqli_real_escape_string($con, $msg);
	if ($msg != ""){
		$date_added = date("Y-m-d");
		$author = "$firstname $lastname";
		$location = "test";
		$time = date("h:i");
		$sqlCommand = "INSERT INTO `posts` (`postid`, `content`, `date_added`, `time`, `author`, `location`) VALUES ('', '$msg', '$date_added', '$time', '$author', '$location')";
		if(mysqli_query($con, $sqlCommand)){
		
		}
		else{
			echo "Oops! Error posting. Please try again.";
		}
	
	}

	else echo "Oops, you can't make an empty post!";

}

?>

<center>
<form action = "#" method = "POST">
<textarea name = "pst" placeholder = "Post Something!"></textarea>
<input type = "submit" name = "send" value = "Post">
</form>
</center>
