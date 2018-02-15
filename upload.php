<?PHP
  if(!empty($_FILES['uploaded_file1']))
  {
    $path = "music/";
    $path = $path . basename( $_FILES['uploaded_file1']['name']);
    if(move_uploaded_file($_FILES['uploaded_file1']['tmp_name'], $path)) {
      header("location:form.html");
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
  if(!empty($_FILES['uploaded_file2']))
  {
    $path = "cover/";
    $path = $path . basename( $_FILES['uploaded_file2']['name']);
    if(move_uploaded_file($_FILES['uploaded_file2']['tmp_name'], $path)) {
      header("location:form.html");
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
?>