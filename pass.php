<html>
<head>
        <title> Password Process </title>
</head>
<body>
<?php
	$username=$_GET["username"];
	$password=$_GET["password"];

	$con=mysqli_connect("localhost" , "admin" , "bob" , "music");
	$rows=mysqli_query($con , "select * from users where username='$username' and password=md5($password)");
	$count=mysqli_num_rows($rows);
	mysqli_close($con);

	if($count == 0)
	{
		die(header("location:index.php?loginFailed=true&reason=password"));
	}
	else
	{
		if($username == "admin")
			header("location:form.html");
		else
			header("location:myWimpy.php?queryWhere=comments&queryValue=Y");
	}
?>
</body>
</html>
