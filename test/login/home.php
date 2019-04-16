<?php 	   
	 include_once('includes/initialize.php');   
	 if(!isset($_SESSION["usn"]))  
	 {   
	      header("location: index.php");
	 }  
	  
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	$userDetails=$userClass->userDetails($_SESSION['usn']);
?>
<h1>Welcome <?php echo $userDetails->fname; ?></h1>

<form method="POST">
	<input type="submit" name="logout" value="Logout"> 
</form>
<?php 
	if(isset($_POST['logout'])) {
	# code...  
	session_destroy();
	header("Location: index.php");
	 
}
?>
</body>
</html>