<?php  
class userClass{  
	public function userLogin($username, $password){
	try{
		$conn = getDB();
		$hash_password= hash('sha256', $password); //Password encryption
		$sql ="SELECT usn FROM tbl_student WHERE username=:username and password=:password";
		$query= $conn -> prepare($sql); 
		$query->bindParam("username", $username,PDO::PARAM_STR) ;
		$query->bindParam("password", $password,PDO::PARAM_STR) ;
		$query->execute();
		$count=$query->rowCount();
		$data=$query->fetch(PDO::FETCH_OBJ);
		$conn = null;
		if($count)
		{
			$_SESSION['usn']=$data->usn;  // Storing user session value
		return true;
		}
		else
		{
		return false;
		} 
	}
	catch(PDOException $e) {
	 echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
	}


	// /* User Registration */
	// public function userRegistration($username,$password,$email,$name)
	// {
	// 	try{
	// 		$db = getDB();
	// 		$st = $db->prepare("SELECT uid FROM users WHERE username=:username OR email=:email"); 
	// 		$st->bindParam("username", $username,PDO::PARAM_STR);
	// 		$st->bindParam("email", $email,PDO::PARAM_STR);
	// 		$st->execute();
	// 		$count=$st->rowCount();
	// 	if($count<1)
	// 	{
	// 		$stmt = $db->prepare("INSERT INTO users(username,password,email,name) VALUES (:username,:hash_password,:email,:name)");
	// 		$stmt->bindParam("username", $username,PDO::PARAM_STR) ;
	// 		$hash_password= hash('sha256', $password); //Password encryption
	// 		$stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
	// 		$stmt->bindParam("email", $email,PDO::PARAM_STR) ;
	// 		$stmt->bindParam("name", $name,PDO::PARAM_STR) ;
	// 		$stmt->execute();
	// 		$uid=$db->lastInsertId(); // Last inserted row id
	// 		$db = null;
	// 		$_SESSION['uid']=$uid;
	// 		return true;
	// 	}
	// 	else
	// 	{
	// 		$db = null;
	// 	return false;
	// 	}

	// 	} 
	// 	catch(PDOException $e) {
	// 		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	// 	}
	// }

		/* User Details */
		public function userDetails($usn)
		{
		try{
			$db = getDB();
			$stmt = $db->prepare("SELECT fname FROM tbl_student WHERE usn=:usn"); 
			$stmt->bindParam("usn", $usn,PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
			return $data;
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
} 


?>