
				google.charts.load('current', {packages: ['corechart', 'bar']});
				google.charts.setOnLoadCallback(drawMultSeries);

				function drawMultSeries() {
					var data = google.visualization.arrayToDataTable(
					[
						['Volume level', 'dB'],['',33],
['',33],
['',25],
['',24],
['',24],
['',24],
['',25],
['',24],
['',36],
['',37],
['',43],
['',44],
['',40],
['',44],
['',37],
['',24],
['',24],
['',25],
['',24],
['',24],
['',23],
['',25],
['',23],
['',24],
['',31],
['',24],
['',25],
['',25],
['',23],
['',27],
['',24],
['',24],
['',24],
['',23],
['',24],
['',48],
['',52],
['',50],
['',41],
['',39],
['',44],
['',41],
['',36],
['',50],
['',51],
['',25],
['',24],
['',24],
['',24],
['',25],
['',23],
['',29],
['',26],
['',32],
['',27],
['',25],
['',21],
['',29],
['',55],
['',53],
['',38],
['',38],
['',24],
['',24],
['',23],
['',24],
['',25],
['',25],
['',25],
['',24],

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
				