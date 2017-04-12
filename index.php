<!doctype html>
<head>
	<meta charset="UTF-8">
	<title> Weather Database </title>
	<meta http-equiv="refresh" content="300">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
</head>
<style type="text/css">
	Canvas {
		padding: 0;
		margin: auto;
		display: block;
	}

</style>

<html>
	<body>
	<h1 align="center">Clemson Weather</h1>
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
		#echo $timestamp;
		$temp = $row[1];
		$gps = $row[2];
		$pressure = $row[3];
		$humidity = $row[4];

	?>
	<ul>
		<li>Timestamp: <?php echo $timestamp?></li>
		<li>Temperature: <?php echo $temp?> </li>
		<li>GPS Location: <?php echo $gps?></li>
		<li>Pressure: <?php echo $pressure?> in</li>
		<li>Humidity: <?php echo $humidity?>%</li>
	</ul>

	<?php
		mysqli_free_result($result);
		//getting timestamp and temp to populate the graph
		$result = mysqli_query($link, "SELECT `timestamp`, temperature FROM weather_attrs ORDER BY timestamp DESC LIMIT 7");
		//$i=0;
		while($row=mysqli_fetch_assoc($result)){
			$array[] = $row;
		//	$ts[$i] = array($row['timestamp']);
		//	$temp[$i] = array($row['temperature']);
		//	$i++;
		}
	?>
	<canvas id="myChart" width="700" height="500"></canvas>	
	<script>
		//Chart.defaults.global.maintainAspectRatio = false;
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			  type: 'line',
			  data: {
			    labels: ['<?php echo $array[6]['timestamp']?>', 
			    		'<?php echo $array[5]['timestamp']?>', 
			    		'<?php echo $array[4]['timestamp']?>', 
			    		'<?php echo $array[3]['timestamp']?>', 
			    		'<?php echo $array[2]['timestamp']?>', 
			    		'<?php echo $array[1]['timestamp']?>', 
			    		'<?php echo $array[0]['timestamp']?>'],
			    datasets: [{
			      label: 'Temperature',
			      data: ['<?php echo $array[6]['temperature']?>',
			      		'<?php echo $array[5]['temperature']?>',
			      		'<?php echo $array[4]['temperature']?>',
			      		'<?php echo $array[3]['temperature']?>',
			      		'<?php echo $array[2]['temperature']?>',
			      		'<?php echo $array[1]['temperature']?>',
			      		'<?php echo $array[0]['temperature']?>'],
			      backgroundColor: "rgba(153,255,51,0.4)"
			    }]     
			  },
			  options: {
			  	responsive: false
			  }
			});
	</script>


		
	</body>
	
</html>