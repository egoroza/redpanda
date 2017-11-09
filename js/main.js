function send_post() {
	var req = new XMLHttpRequest();
	var follow = "send_post.php";
	var fn = document.getElementById("post").value;
	var vars = "post="+fn;
	req.open("POST", follow, true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
		if(req.readyState == 4 && req.status == 200){
			var return_data = req.responseText;
			document.getElementById("status").innerHTML = return_data;
		}
	}
	req.send(vars);
	document.getElementById("status").innerHTML = "Posting...";
}