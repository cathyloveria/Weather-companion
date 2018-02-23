<?php
require('connect.php');
$id = $_SESSION["userid"];
$uname = strtoupper($_SESSION["username"]);

if (isset($_POST['submit'])){
	//checks if field is empty
	if($_POST['name'] == ""){ ?>
		<script>
			alert('Empty City Field!');
			window.location.href = 'addcity.php';
		</script>
	<?php
	}
	else {
	$City = strtoupper($_POST['name']);
	//retrieve weather info from api.openweathermap.org
	$request = "http://api.openweathermap.org/data/2.5/weather?APPID=4bbf1917f329a8f633bf8ac09f3ac29b&q=".$City."";
	$response  = file_get_contents($request);
	$jsonobj  = json_decode($response,true);

	//Get current Temperature in Celsius
	$kelvin=$jsonobj['main']['temp'];
	$celsius=($kelvin - 273.15);

	$sql = "SELECT * FROM weather WHERE fors='$id' and city='$City'";
	$results = mysqli_query($conn,$sql);
	$count = mysqli_num_rows($results);

	if($count >= 1){ ?>
		<script>
			alert('Already Added City');
		</script>
    <?php }
	else {
		$query = "INSERT INTO weather (id,city,celsius,fors) VALUES('','$City','$celsius','$id')";
		$result = mysqli_query($conn,$query);
		if($result){ ?>
			<script>
				alert('Successfully Added!');
			</script>
		<?php }
	}
}}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style_table.css">
</head>
<body>
	<img src="trendmicro.png" alt="Trendmicro" height = "10%">
	<form action="" method="post">
	<?php echo "Hi "; ?><b><?php echo $uname ."!"; ?></b>
	<p align ="middle"><br>Enter City <input type="text" name="name" />
	<button type="submit" name="submit">ADD</button>
	<input type="button" onclick="location.href='/php/removeCity.php';" value="REMOVE" />
	</p>
	<table>
	<?php
		$sql = "SELECT * FROM weather WHERE fors = $id";
		$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$count = mysqli_num_rows($result);
		if($count>0){ ?>
			<tr>
			<th>Cities</th>
			<th>° C</th>
			</tr>
		<?php
		//display the cities and its temperature in Celsius
		while($row = mysqli_fetch_array($result)){ ?>
			<tr>
			<td><?php echo $row['city']; ?></td>
			<td><?php echo $row['celsius']; ?></td>
			</tr>
		<?php
		}}
	?>
	</form>
	</table>
</body>
</html>
