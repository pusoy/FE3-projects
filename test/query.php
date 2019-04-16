<?php
	include_once('includes/initialize.php');    
	$getUsers = $DB->query("INSERT * FROM tbl_student WHERE usn='C15-01-3720-MAN121'");  
	print_r($getUsers);
 ?>
