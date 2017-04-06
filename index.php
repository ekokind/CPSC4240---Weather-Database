<!doctype html>
<head>
	<meta charset="UTF-8">
	<title> Weather Database </title>
	<meta http-equiv="refresh" content="300">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
</head>


<html>
	<body>
	<?php
	//	session_start(); //cant find this anywhere
	//	include_once "mysqlClass.inc.php"; //has the functions
		$link = mysqli_connect('localhost', 'root', '', 'cpsc424_6jt3');
		if (mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
	    	exit();
		}

		//echo 'Connected successfully';

		if ($result = mysqli_query($link, "SELECT DATABASE()")) {
	    	$row = mysqli_fetch_row($result);
	    	//printf("Default database is %s.\n", $row[0]);
	    	mysqli_free_result($result);
		}

		mysqli_select_db($link, "cpsc424_6jt3");

		$result = mysqli_query($link, "SELECT * FROM weather_attrs ORDER BY timestamp DESC LIMIT 1");
		$row = mysqli_fetch_row($result);
		$timestamp = $row[0];
		echo $timestamp;
		$temp = $row[1];
		$gps = $row[2];
		$pressure = $row[3];
		$humidity = $row[4];
	?>
	<canvas id="myChart"></canvas>	
	<script>
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			  type: 'line',
			  data: {
			    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
			    datasets: [{
			      label: 'Temperature',
			      data: [12, 19, 3, 17, 6, 3, 7],
			      backgroundColor: "rgba(153,255,51,0.4)"
			    }] 
			    
			  }
			});
	</script>

	<ul>
		<li>Timestamp: <?php echo $timestamp?></li>
		<li>Temperature: <?php echo $temp?> &deg;F</li>
		<li>GPS Location: <?php echo $gps?></li>
		<li>Pressure: <?php echo $pressure?> in</li>
		<li>Humidity: <?php echo $humidity?>%</li>
	</ul>
		
	</body>
	
</html>