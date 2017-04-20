<!--In this program I used Google API to draw a chart which contains last 10s of record-->
<!--The file code.js will be overwritten after 1s in order to update new data-->
<html>
	<head>
		<title>Sound detector - Real time</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>	<!--Import the jQuery library-->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>		<!--Link to Google API-->
	</head>
	<body style="text-align:center; background-color:#ccffff">
		<h1 style="text-color:red">Sound detector project in realtime</h1>
		<p style="text-color:red">Showing last 10s of record</p>
		<br><br>
		
		<div id="chart_div" style="height:600"></div> <!--Show the graph here-->
		
		<script id="code" type="text/javascript">	<!--This script tag is use to display the code-->
		</script>
		
		<script type="text/javascript">
			var auto_refresh = setInterval(function ()
			{
				$('#code').load('load.php');		//Run the load.php to get new code.js file
				$.getScript("code.js");				//Load the code.js to show the graph
			}, 900);
		</script>
		<br><a href="query.php">Click here to see data with your query</a>
	</body>
</html>
