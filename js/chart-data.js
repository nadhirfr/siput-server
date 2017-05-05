var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};

function ambilData() {
	var base_url = window.location.origin;
	var url = base_url+"/siput-server/index.php/transaksis?param=getMonth&month="+arguments[0]+"&tipe="+arguments[1];
	var result = null;
              $.ajax(
              {
                url: url,
                type: 'get',
                dataType: 'html',
                async: false,
                cache: false,
                success: function(data) 
                {
                    result = data;
                }
              });
     return $(result).find("td").text();
}


	
	var lineChartData = {
			labels : ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
			datasets : [
				{
					label: "Iuran",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [ambilData(1,"iuran"),
					ambilData(2,"iuran"),
					ambilData(3,"iuran"),
					ambilData(4,"iuran"),
					ambilData(5,"iuran"),
					ambilData(6,"iuran"),
					ambilData(7,"iuran"),
					ambilData(8,"iuran"),
					ambilData(9,"iuran"),
					ambilData(10,"iuran"),
					ambilData(11,"iuran"),
					ambilData(12,"iuran")]
				},
				{
					label: "Pengeluaran",
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 1)",
					pointColor : "rgba(48, 164, 255, 1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(48, 164, 255, 1)",
					data : [ambilData(1,"pengeluaran"),
					ambilData(2,"pengeluaran"),
					ambilData(3,"pengeluaran"),
					ambilData(4,"pengeluaran"),
					ambilData(5,"pengeluaran"),
					ambilData(6,"pengeluaran"),
					ambilData(7,"pengeluaran"),
					ambilData(8,"pengeluaran"),
					ambilData(9,"pengeluaran"),
					ambilData(10,"pengeluaran"),
					ambilData(11,"pengeluaran"),
					ambilData(12,"pengeluaran")]
				}
			],
			

		}
		
	var barChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,0.8)",
					highlightFill: "rgba(220,220,220,0.75)",
					highlightStroke: "rgba(220,220,220,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					fillColor : "rgba(48, 164, 255, 0.2)",
					strokeColor : "rgba(48, 164, 255, 0.8)",
					highlightFill : "rgba(48, 164, 255, 0.75)",
					highlightStroke : "rgba(48, 164, 255, 1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]
	
		}

	var pieData = [
				{
					value: 300,
					color:"#30a5ff",
					highlight: "#62b9fb",
					label: "Blue"
				},
				{
					value: 50,
					color: "#ffb53e",
					highlight: "#fac878",
					label: "Orange"
				},
				{
					value: 100,
					color: "#1ebfae",
					highlight: "#3cdfce",
					label: "Teal"
				},
				{
					value: 120,
					color: "#f9243f",
					highlight: "#f6495f",
					label: "Red"
				}

			];
			
	var doughnutData = [
					{
						value: 300,
						color:"#30a5ff",
						highlight: "#62b9fb",
						label: "Blue"
					},
					{
						value: 50,
						color: "#ffb53e",
						highlight: "#fac878",
						label: "Orange"
					},
					{
						value: 100,
						color: "#1ebfae",
						highlight: "#3cdfce",
						label: "Teal"
					},
					{
						value: 120,
						color: "#f9243f",
						highlight: "#f6495f",
						label: "Red"
					}
	
				];

window.onload = function(){
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true,
		legend: {
            display: true,
            labels: {
                fontColor: 'rgb(255, 99, 132)'
				}
		}
		
	});
	var chart2 = document.getElementById("bar-chart").getContext("2d");
	window.myBar = new Chart(chart2).Bar(barChartData, {
		responsive : true
	});
	var chart3 = document.getElementById("doughnut-chart").getContext("2d");
	window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
	});
	var chart4 = document.getElementById("pie-chart").getContext("2d");
	window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
	});
	
};