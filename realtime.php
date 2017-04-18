<!--In this program I used Google API to draw a chart which contains last 10s of record-->
<html>
	<head>
		<title>Sound detector - Real time</title>
	</head>
	<body style="text-align:center;">
		<h1>Sound detector project in realtime</h1>
		<!-- This php code will write all the recorded-data to <input> with type hidden and number id(s) for all -->
		<br>
		<br>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<div id="chart_div" style="height:600"></div>
      
		<script type="text/javascript">

			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawMultSeries);

			function drawMultSeries() {
				var data = google.visualization.arrayToDataTable(
				[
					['Volume level', 'dB'],
					<?php 
					
						$file = file("sound.log");
						for ($i = max(0, count($file)-10); $i < count($file); $i++) 
						{	
							$string = $file[$i];
							$string = trim(preg_replace('/\s+/', ' ', $string));
							$a = explode(";",$string);
							foreach($a as $content)
							{
								echo "['',".intval(20*log10($content))."],\r\n";		//convert it to dB
							}
						}					
					?>
				],
			  false); // 'false' means that the first row contains labels, not data.

				  var options = 
				  {
					title: 'REAL TIME SOUND DETECTOR',
					hAxis: {
					  title: 'Time (s)',
					  viewWindow: {
						min:0,
						max:100 
					  }
					},
					vAxis: {
					  title: 'Volume level (dB)',
					  viewWindow: {
						min:0,
						max:100 
					  }
					}
				  };

				  var chart = new google.visualization.ColumnChart(
					document.getElementById('chart_div'));

				  chart.draw(data, options);
				}
			setTimeout("location.reload()",1000);	//This page will be reload every 1s in order to update the data
		</script>
	</body>
</html>
