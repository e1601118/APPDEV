<!--In this file I update content to file code.js every 1s-->
<!--code.js is used to display the graph-->
<!--To see the format of code.js, check https://developers.google.com/chart/interactive/docs/gallery/columnchart-->

<?php 
			$writetofile="";		//$writetofile is use to save all the content of file code.js as a string
			$writetofile.="
				google.charts.load('current', {packages: ['corechart', 'bar']});
				google.charts.setOnLoadCallback(drawMultSeries);

				function drawMultSeries() {
					var data = google.visualization.arrayToDataTable(
					[
						['Volume level', 'dB'],";

						// 1 line in sound.log has format as date;a;b;c;d;e;f;g;h
						$file = file("sound_log.txt");
						for ($i = max(0, count($file)-10); $i < count($file); $i++) 
						{	
							$string = $file[$i];
							$string = trim(preg_replace('/\s+/', ' ', $string));
							$a = explode(";",$string);
							foreach ($a as $content)
							{
									if (intval(20*log10($content))!=0)			//This will check if it's not 0 and in numberic format
										$writetofile.="['',".intval(20*log10($content))."],\r\n";		//convert it to dB and write to file code.js
										//Every content of the graph has format ['',<number>],
							}
						}					
			//Continue writing content of code.js
			$writetofile.= "
			],
				  false);

					  var options = 
					  {
						backgroundColor: '#ccffcc',
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

					  var chart = new google.visualization.LineChart(
						document.getElementById('chart_div'));

					  chart.draw(data, options);
					}
				";		
		echo "function reload() {".$writetofile."}";	//Echo this to the realtime.php file for check/debug
		$f = fopen("code.js","w");
		fwrite($f,$writetofile);						//And write it to code.js file
		fclose($f);
?>