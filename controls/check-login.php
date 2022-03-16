<?php  
session_start();
include "../controls/connection.php";


if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	$username = test_input($_POST['username']);
	$password = test_input($_POST['password']);
	$role = test_input($_POST['role']);

	if (empty($username)) {
		
		header("Location: ../Login.php?error=User Name is Required");
	}else if (empty($password)) {
		
		header("Location: ../Login.php?error=Password is Required");
	}else {

		// Hashing the password
		$password = md5($password);
        
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
        	
			$row = mysqli_fetch_assoc($result);
        		$_SESSION['name'] = $row['FirstName'] ." ".$row['LastName'];
        		$_SESSION['id'] = $row['UserID'];
        		$_SESSION['role'] = $row['Role'];
        		$_SESSION['username'] = $row['UserName'];

        		header("Location: ../index.php");

        	}
        else {
        	header("Location: ../Login.php?error=Incorect User name or password");
        }

	}
	
}else {
	header("Location: ../index.php");
}