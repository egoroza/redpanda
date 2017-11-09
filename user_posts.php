<div style = "overflow:auto;text-align:left;">
<?php
include ("./inc/connect.inc.php");
$author = "$firstname $lastname";

$query = "SELECT * FROM posts WHERE author='$author' ORDER BY postid DESC LIMIT 5";
$getPosts = mysqli_query($con, $query);

if(!mysqli_num_rows($getPosts) == 0){
	while($row = $getPosts->fetch_assoc()){
		$id = $row['postid'];
		$msg = $row['content'];
		$date = $row['date_added'];
		$location = $row['location'];

		echo "$author says: $msg <br> $date<br><hr>";
	}
}

else echo "Looks like you haven't posted anything yet.";

?>
</div>

