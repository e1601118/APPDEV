<html>
	<head>
		<title>Draw</title>
	</head>
	<body style="text-align:center;">
		<h1>Sound detector project</h1>
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
				echo "<input type='hidden' id='num' value='".--$i."'>";
			}
		?>
		<br>
		<br>
		<img src="ruler.png" style="height:500px">
		<canvas id="myCanvas" width="800" height="500" style="border:2px solid #154423;">  //Show 10s. Each 1s has 10px. 8*10*10. Every 1dB has 5px. 5*100
		</canvas>
		<p id='info'></p>		<!--Show infomation -->
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
				ctx.moveTo(x,500-y);
				ctx.lineTo(a,500-b);
				ctx.stroke();
			}
			
			
			function realtime()
			{
				var c = document.getElementById("myCanvas");
				c.width = c.width;
				c.height = c.height;
				var ctx = c.getContext("2d");
				ctx.clearRect(0, 0, c.width, c.height);
				//Use to clear the canvas
				var n = Number(document.getElementById("num").value);
				var to = n/8;
				var fro = to-7;
				//document.getElementById("info").innerHTML="Showing record from "+fro+" sec to "+to+" sec.";
				if (fro>=0)
				{
					var j=0;
					ctx.lineWidth = 4;
					for (i=fro*8;i<to*8;i++)
					{			
						ctx.strokeStyle = getRandomColor();
						ctx.stroke();
						var id1=i.toString();
						var id2=(i+1).toString();
						//If data are not in dB yet
						var a = Math.log10(document.getElementById(id1).value)*100;
						var b = Math.log10(document.getElementById(id2).value)*100;		//*100 means *5 for 5px/dB and *20 for 20*log10()
						//If data are in dB
						//var a = document.getElementById(id1).value*5;					//Each dB has 5px in canvas
						//var b = document.getElementById(id2).value*5;
						draw(j*10,a,(j+1)*10,b);			//Each sec has 10px in canvas
						j++;
					}
				}
			}
			realtime();
			setTimeout("location.reload()",1000);
		</script>		
		
		
	</body>
</html>
