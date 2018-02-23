<?php
require('connect.php');
$id = $_SESSION["userid"];
$uname = strtoupper($_SESSION["username"]);
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style_table.css">
</head>
<body>
	<img src="trendmicro.png" alt="Trendmicro" height = "10%">
	<form action="" method="post">
	<p style="text-indent: 5em;"><?php echo "Hi "; ?><b><?php echo $uname ."!"; ?></b>
	<p style="text-indent: 20em;"><input type="button" onclick="location.href='/php/addcity.php';" value="ADD" /></p>
	<p style="text-indent: 20em;"><button type="submit" name="remove" >REMOVE</button></p>
	<table>
		<tr>
		<th>Cities</th>
		<th> °C</th>
		<th>Action</th>
	</tr>

	<?php
	$sql = "SELECT * FROM weather WHERE fors = $id";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$count = mysqli_num_rows($result);

	//displays all the cities and their temp with checkbox at the action column
	if($count>0){
		while($row = mysqli_fetch_array($result)){ ?>
		<tr>
		<td><?php echo $row['city']; ?></td>
		<td><?php echo $row['celsius']; ?></td>
		<td><input type="checkbox" name="deletee[]" value="<?php $rid=$row['ID']; echo $rid ?>"></td>
		</tr>
	<?php }}

	//display the message when database is empty
	else { ?>
		<script>
			alert('No City to be removes!');
			window.location.href = 'addcity.php';
		</script>
	<?php
	}
	if (isset($_POST['remove'])){
		$cnt=array();
		$cnt=count($_POST['deletee']);
		for($i=0;$i<$cnt;$i++){
			$del_id=$_POST['deletee'][$i];
			$query = "DELETE FROM weather WHERE ID = $del_id";
			mysqli_query($conn,$query);
		} ?>
		<script>
			alert('Successfully deleted!');
			window.location.href = 'addcity.php';
		</script>
	<?php
	}
	?>

</form>
</table>
</body>
</html>
