<!doctype html>
<head>
	<meta charset="UTF-8">
	<title> Weather Database </title>
</head>

<?php
	session_start();
	include_once "mysqlClass.inc.php";
?>

<body>
	<?php
		$query = "SELECT * FROM weather_attrs WHERE MAX(timestamp)";
		$result = mysql_query($query);
		$result_row = mysql_fetch_row($result) 

		$timestamp = $result_row[0];
		$temp = $result_row[1];
		$gps = $result_row[2];
		$pressure = $result_row[3];
		$humidity = $result_row[4];

		echo $timestamp;
		echo $temp;
		echo $gps;
		echo $pressure;
		echo $humidity;
	?>

</body>