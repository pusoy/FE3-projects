<?php
  include_once('includes/initialize.php');   
  if(isset($_SESSION["usn"]))  
   {   
        header("location: home.php");
   }  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
<form method="POST"> 
<div class="login-box"> 
  <h1>Login</h1>
      <div class="textbox">
        <i class="fas fa-user"></i>
        <input type="text" name="username" placeholder="Username">
      </div>

      <div class="textbox">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password">
      </div>

    <input type="submit" class="btn" name="signIn" value="Sign in">
  </div>
</form> 
 
</body>
</html>
