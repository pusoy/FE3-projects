<?php 

	$userClass = new userClass();
	if (isset($_POST['signIn']))
	{
		$errorMsgReg='';
		$errorMsgLogin=''; 
		$username=$_POST['username'];
		$password=$_POST['password'];
		if(strlen(trim($username))>1 && strlen(trim($password))>1 )
		{
			$usn=$userClass->userLogin($username,$password);  
		if($usn)
		{
			header("Location: home.php"); // Page redirecting to home.php 
		}
		else
		{
			$errorMsgLogin="Please check login details.";
		}
		}
	}
?>