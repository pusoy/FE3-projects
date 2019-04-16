<?php
	// if(!empty($_SESSION['usn']))
	// {
	// 	$session_usn=$_SESSION['usn'];  
	// }
	// if(empty($session_usn))
	// { 
	// 	header("Location: index.php");
	// } 
	if(isset($_SESSION["usn"]))  
	 {   
	      header("location: home.php");
	 }  
	 else  
	 {  
	      header("location: index.php");  
	 }  
?>