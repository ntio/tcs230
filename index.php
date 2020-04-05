<html>

<head>
	<title>Arduino.dht11 chart</title>
	 <script src="../js/jquery.min.js"></script>
	<script src="../js/Chart.min.js"></script>
	<script src="../js/utils.js"></script>
	<script src="../js/chartjs-plugin-zoom.js"></script>
	<script src="../js/chartjs-plugin-streaming.js"></script>
	
	
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> -->
	<style>
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	#reloj { width: 150px; height: 30px; padding: 5px 10px; border: 1px solid black; 
         font: bold 1.5em dotum, "lucida sans", arial; text-align: center;
         float: right; margin: 1em 3em 1em 1em; }
	</style>
	
</head>

<body>
	<div style="width:75%;">
		<canvas id="canvas"></canvas>
	</div>
		
    <div id="reloj">
   00 : 00 : 00
  </div>
	<script>
	  function getData(url) {
        obj = {id: [], rojo: [], verde: [], azul: []};
        var id = [], rojo = [],verde = [],azul = [];

        var jsonData = $.ajax({
          url: url,
          dataType: 'json',
          async: false
        }).done(function (results) {
          // Split timestamp and data into separate arrays
          results.forEach(function(packet) {
            id.push(packet.id);
            rojo.push(packet.rojo);
            verde.push(packet.verde);
            azul.push(packet.azul);
            
          });
        });
        obj["id"] = id;
        obj["rojo"] = rojo;
        obj["verde"] = verde;
        obj["azul"] = azul;
        return obj;
      }

	     Chart.defaults.global.defaultFontSize = 18;
		 var dataYearlyValue = getData('getvalores.php?q=y');
		 
		var config = {
		    labels : dataYearlyValue.id,
			datasets: [{
					label: 'rojo',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data:dataYearlyValue.rojo,
					fill: false,
				
				},
				{
					label: 'verde',
					backgroundColor: window.chartColors.green,
					borderColor: window.chartColors.green,
					data:dataYearlyValue.verde,
					fill: false,
				
				},
				{
					label: 'azul',
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data:dataYearlyValue.azul,
					fill: false,
				}]
			};
			
      // Get the context of the canvas element we want to select
      var ctx = document.getElementById("canvas").getContext("2d");
      var YearlyChart = new Chart(ctx, {
        type: 'line',
        data: config,
        animation:{
          animateScale: true
        },
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Arduino.tcs230'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: false
				},
				scales: {
					xAxes: [{					   
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'id'
						},
						ticks: {
							reverse: true 
						}
					}],
					yAxes: [{
					     ticks: {
                        beginAtZero: false
                            },
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'tcs230:rojo,verde,azul'
						}
					}]
				},
				pan: {
					enabled: false,
					mode: 'x',
					rangeMax: {
						x: 4000
					},
					rangeMin: {
						x: 0
					}
				},
				zoom: {
					enabled: false,
					mode: 'x',
					rangeMax: {
						x: 20000
					},
					rangeMin: {
						x: 10000
					}
				}
			}
		});

		
				
		function actual() {
         fecha2=new Date(); //Actualizar fecha.
         hora=fecha2.getHours(); //hora actual
         minuto=fecha2.getMinutes(); //minuto actual
         segundo=fecha2.getSeconds(); //segundo actual
         if (hora<10) { //dos cifras para la hora
            hora="0"+hora;
            }
         if (minuto<10) { //dos cifras para el minuto
            minuto="0"+minuto;
            }
         if (segundo<10) { //dos cifras para el segundo
            segundo="0"+segundo;
            }
         //ver en el recuadro del reloj:
         mireloj = hora+" : "+minuto+" : "+segundo;	
				 return mireloj; 
         }
         function actualizar() { //función del temporizador
          mihora=actual(); //recoger hora actual
           mireloj=document.getElementById("reloj"); //buscar elemento reloj
           mireloj.innerHTML=mihora; //incluir hora en elemento
         
	      }
	       setInterval(function(){

        var updateDataYearly = getData('getvalores.php?q=y');
        YearlyChart.data.labels = updateDataYearly.id;
        YearlyChart.data.datasets[0].data = updateDataYearly.rojo;
        YearlyChart.data.datasets[1].data = updateDataYearly.verde;
        YearlyChart.data.datasets[2].data = updateDataYearly.azul;
        YearlyChart.update();
        actualizar();
         }, 1000);
         
			  

	</script>
	
 </body>

</html>

