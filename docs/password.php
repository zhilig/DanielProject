<?php //file login.php
// Include database connection
require_once('inc/connect.php');
// Include functions
require_once('inc/functions.php');

session_start(); 
session_regenerate_id(true); 

$username = $_REQUEST['username'];
$pass = $_REQUEST['pass'];

         // build SELECT query
         $query ="SELECT * FROM PET_ACCOUNT WHERE USERNAME  = '".$username."'";

		$flag=false;
   
         /* check the sql statement for errors and if errors report them */
		$stmt = OCIParse($db, $query);

		if(!$stmt) {
		echo "An error occurred in parsing the sql string.\n";
		exit;
		}
		OCIExecute($stmt);
		while(OCIFetch($stmt)) {
			if(OCIResult($stmt,"PASSWORD")==$pass) {
			$flag=true;	
			
			$username=OCIResult($stmt,"USERNAME");
			$password=OCIResult($stmt,"PASSWORD");
			$email=OCIResult($stmt,"EMAIL");
			$phone=OCIResult($stmt,"PHONE");
			$address=OCIResult($stmt,"ADDRESS");
			
			//set up session values
			//session_start();
			$_SESSION['id'] = OCIResult($stmt,"ID"); 
			$_SESSION['username'] = $username; 
			$_SESSION['pass'] = $password;	
			$_SESSION['email'] = $email;
			$_SESSION['phone'] = $phone;
			$_SESSION['address'] = $address;
			//$_SESSION['sessionID']=$PHPSESSID;
			}
		} //end of while
?>
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Pet Shop</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

		<?php
		if ($flag) 
		{
			$username = $_SESSION['username']; 
			$pass = $_SESSION['pass']; 
			$id= $_SESSION['id'];
			$email = $_SESSION['email'];
			$phone = $_SESSION['phone'];
			$address = $_SESSION['address'];
			echo "<h1>Hello $username, welcome to our System! </h1>";
			echo "Welcome $username <br /><br />";	
			echo "Do you want to change your profile? <br /><br />";
			echo "<form method='post' action='profile.php'>";
			echo "User Name: <input type='text' name='username' value='$username'> <br /><br />";
			echo "Password: <input type='password' name='pass' value='$pass'> <br /><br />";
			
			echo "Email address: <input type='text' name='email' value='$email'> <br /><br />";
			echo "phone number: <input type='text' name='phone' value='$phone'> <br /><br />";
			echo "Address: <input type='text' name='address' value='$address'> <br /><br />";
			
			echo "<input type='submit' value='submit'>";
			echo "</form>";
			
		} //end of if
		else {
		
			echo "Your password is wrong or your username doesn't exist. Sorry.<br /><br />";
		}
		
		//echo "this is your session id: ".$_SESSION['sessionID']."<br /><br />";
		echo "this is your session_id(): ".session_id();
		OCILogOff($db);
?> 




</body>
</html>