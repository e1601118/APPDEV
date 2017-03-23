<html>
	<head>
		<title>Draw</title>
	</head>
	<body style="text-align:center;">
		<h1>Sound detector project</h1>
		<!-- This php code will write all the recorded-data to <input> with type hidden and number id(s) for all -->
		<?php 
			{
				$f = fopen("sound.log","r+");
				$i = 0;
				while (!feof($f))
				{
					$string = fgets($f);
					$string = trim(preg_replace('/\s+/', ' ', $string));
					$a = explode(";",$string);
					foreach($a as $content)
					{
						echo "<input type='hidden' id='".$i."' value='".$content."'>";
						$i += 1;
					}
				}
				echo "<input type='hidden' id='num' value='".--$i."'>";		//This will show how many input fields has been written
			}
		?>
		<br>
		<br>
		<img src="ruler.png" style="height:500px"> <!-- Ruler appear in the right of canvas use to measure the dB -->
		<canvas id="myCanvas" width="800" height="500" style="border:2px solid #154423;">  //Show 10s. Each 1s has 10px. 8*10*10. Every 1dB has 5px. 5*100
		</canvas>
		<script>
			
			function getRandomColor() 		//Get random color code
			{
				var letters = '0123456789ABCDEF';
				var color = '#';
				for (var i = 0; i < 6; i++ ) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
			}
			
			function draw(x,y,a,b)		//Draw a line from point (x;y) to (a;b)
			{
				var c = document.getElementById("myCanvas");
				var ctx = c.getContext("2d");
				ctx.moveTo(x,500-y);		//Because the point (0;0) starts from the left-top
				ctx.lineTo(a,500-b);
				ctx.stroke();
			}
			
			
			function realtime()
			{
				//Initialize the canvas and get its context
				var c = document.getElementById("myCanvas");
				c.width = c.width;
				c.height = c.height;
				//Clear the canvas to draw a new graph
				var ctx = c.getContext("2d");
				ctx.clearRect(0, 0, c.width, c.height);
				//Calculate the time from beginning of the graph to the end
				var n = Number(document.getElementById("num").value);
				var to = n/8;
				var fro = to-7;		//Display 7 seconds of record data
				if (fro>=0)			//If fro is postive (>0s) then start to draw
				{
					var j=0;		//Start from point (0;*)
					ctx.lineWidth = 4;
					for (i=fro*8;i<to*8;i++)
					{			
						ctx.strokeStyle = getRandomColor();		
						ctx.stroke();							//Get and set random color
						var id1=i.toString();					//Make id i into string
						var id2=(i+1).toString();				//Make id i+1 into string
						//If data are not in dB yet
						var a = Math.log10(document.getElementById(id1).value)*100;		//Get value from id i
						var b = Math.log10(document.getElementById(id2).value)*100;		//*100 means *5 for 5px/dB in canvas and *20 for 20*log10()
						//If data are in dB
						//var a = document.getElementById(id1).value*5;					//Each dB has 5px in canvas
						//var b = document.getElementById(id2).value*5;
						draw(j*10,a,(j+1)*10,b);			//Each sec has 10px in canvas
						j++;
					}
				}
			}
			realtime();			//Call the function to draw
			setTimeout("location.reload()",1000);	//This page will be reload every 1s in order to update the data
		</script>		
		
		
	</body>
</html>
