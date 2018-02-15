<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  
<div class="container">
  <form action="pass.php" method="GET">
    <div class="row">
      <h4>Login</h4>
      <div class="input-group input-group-icon">
        <input type="text" name="username" placeholder="Username"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="password" name="password" placeholder="Password"/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
      <div class="input-group input-group-icon">
       <input type="submit" value="Login" autofocus/><br>
       <div class="input-icon"><i class="fa fa-sign-in"></i></div>
      </div>
      <?php
          $reasons = array("password" => "Wrong Username or Password", "blank" => "You have left one or more fields blank.");
          if (@$_GET["loginFailed"])
            echo $reasons[@$_GET["reason"]];
       ?>
    </div>
  </form>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>
