<html>
	<head>
		<title>Showing graph from time</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>	<!--Import the jQuery library-->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>		<!--Link to Google API-->
	</head>
	<body style="text-align:center; background-color:#ccffff">
		<form>
			<p>Type the time you want to see with format:<br> MMM dd YYYY HH:ii:ss (Show in GMT 0)<br>(<b>example:</b> Apr 09 2017 12:40)</p>
			<input type="text" name="query" autocomplete="off">
			<input type="submit">
		</form>
		<hr style="height: 10px;border: 0;box-shadow: 0 10px 10px -10px #8c8b8b inset;"/>
		<?php 
			$get="";
			if (!isset($_GET["query"]) || empty($_GET["query"]))
				echo "<h1>Please type query as above</h1>";
			else
			{
				echo "<h1>Showing data on ".$_GET["query"]."</h1>";
				echo "<div id='chart_div' style='height:600'></div>";
				
				$file = file("sound_log.txt");
				//Filter of query. Only take what contain the query
				for ($i=0;$i<=count($file);$i++)
				{
					$content = $file[$i];
					if (strpos($content,$_GET["query"])!==false)
						$get.=$content;
				}
				//Write $get to query
				$f = fopen("query.txt","w");
				fwrite($f,$get);
				fclose($f);
			}
		?>
		<script>
				google.charts.load('current', {packages: ['corechart', 'bar']});
				google.charts.setOnLoadCallback(drawMultSeries);

				function drawMultSeries() {
					var data = google.visualization.arrayToDataTable(
					[
						['Volume level', 'dB'],
						<?php 
							$file = file("query.txt");
							for ($i=0; $i < count($file); $i++) 
							{	
								$string = $file[$i];
								$string = trim(preg_replace('/\s+/', ' ', $string));
								$a = explode(";",$string);
								$count = 0;
								foreach ($a as $content)
								{
									if ($count==0) {$date = $content; $count++;}
										if (intval(20*log10($content))!=0)			//This will check if it's not 0 and in numberic format
											$writetofile.="['".$date."',".intval(20*log10($content))."],\r\n";		
											//Convert it to dB and write to file code.js
											//Every content of the graph has format ['<label>',<number>],
								}
							}
							echo $writetofile;
						?>
						],
						false);

					  var options = 
					  {
						backgroundColor: '#ccffcc',
						title: 'QUERY DATA',
						hAxis: {
						  title: 'Time (s)',
						  viewWindow: {
							min:0, 
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

					  var chart = new google.visualization.LineChart(
						document.getElementById('chart_div'));

					  chart.draw(data, options);
					}
		</script>
		<br><a href="realtime.php">Click here to see realtime</a>
	</body>
</html>