<html>
<head> <title> Upload Process </title> <head>
<body>
<?php
	$id=$_GET["id"];
	$filename=$_GET["filename"];
	$artist=$_GET["artist"];
	$title=$_GET["title"];
	$visual=$_GET["visual"];
  	$comments="Y";

	$con=mysqli_connect("localhost" , "admin" , "bob" , "music");
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
	$rows=mysqli_query($con, "insert into mp3s values('$id','$filename','$artist','$title', 'http://localhost/mp3s/cover/$visual' ,'$comments')");
	mysqli_close($con);

  header("location:form.html");
?>
</body>
</html>

