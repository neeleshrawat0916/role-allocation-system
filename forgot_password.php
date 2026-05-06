<?php
//connection
require("config/connection.php");

if(isset($_POST['submit'])){
	$email = trim(mysqli_real_escape_string($connection, $_POST['email']));
	$password = md5($_POST['password']);

	//Email Already exists
	$check= "SELECT * FROM school WHERE (email = '$email')";
	$query1 = mysqli_query($connection, $check);
	
	
	//check if email already exist in any row
	
		$fetch = mysqli_fetch_array($query1);
		
		
		if (mysqli_num_rows($query1) > 0)
        {
            	$update = "UPDATE school SET password = '$password' WHERE email = '$email'";
				$query = mysqli_query($connection, $update);
		}
		
		else{
		
		echo "<script>alert('user not exist');</script>";
}
}
?>

<form method="POST">
<label> Email Id</label>
<input type="email" name="email">

<label> Enter New Password</label>
<input type="password" name="password">

<input type="submit" name="submit" value="submit">
</form>
