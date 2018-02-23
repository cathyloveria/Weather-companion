<?php
require('connect.php');

//checks if the username field or password field is empty
if (isset($_POST['submit'])){
	if($_POST['username'] == "" || $_POST['password'] == ""){ ?>
		<script>
			alert('Empty Username or Password!');
			window.location.href = 'addUser.php';
		</script>
	<?php
	}

//Add new user to the database
else{
	if(isset($_POST['username']) && isset($_POST['password'])){
		$user = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM user WHERE username='$user' and password='$password'";
		$results = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($results);

		//validate if user's details are already existed in the database before adding them to database
		if($count >= 1){ ?>
            <script>
                alert('User Already Existed!!');
                window.location.href = 'addUser.php';
            </script>
        <?php 
		}
		else{
			$query = "INSERT INTO user (id,username,password) VALUES('','$user','$password')";
			$result = mysqli_query($conn,$query);
			if($result){ ?>
            	<script>
				alert('User Successfully added!');
				window.location.href = 'addUser.php';
				</script>
			<?php }
			else echo "Error Adding";
		}}}}
?>

<html>
<head>
	<title>Add New User</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<img src="trendmicro.png" alt="Trendmicro" height = "10%">
	<p style="text-indent: 21em;"><font face="verdana" size="7" color="black">Register</font></p>
	<form method='post' action='' >
		<div class='Login-details'>
			<label>Username:</label>
			<input type='text' name='username' >
			<label>Password:</label>
			<input type='text' name='password' ><br />
			<br>
			<input type='submit' value='Submit' class = 'btn' name='submit' />
			<br>
			<br>
			<a href="Login.php" >Back to Login Page</a>
		</div>
	</form>
</body>
</html>