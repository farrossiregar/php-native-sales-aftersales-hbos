var Charts = function() {"use strict";
	
	var barChartHandler = function() {
		var options = {

			// Sets the chart to be responsive
			responsive: true,

			//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			scaleBeginAtZero: true,

			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,

			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",

			//Number - Width of the grid lines
			scaleGridLineWidth: 1,

			//Boolean - If there is a stroke on each bar
			barShowStroke: true,

			//Number - Pixel width of the bar stroke
			barStrokeWidth: 2,

			//Number - Spacing between each of the X value sets
			barValueSpacing: 5,

			//Number - Spacing between data sets within X values
			barDatasetSpacing: 1,

			//String - A legend template
			legendTemplate: '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
		};
		
		
		var split_gabung_pencapaian_bulanan = gabung_pencapaian_bulanan.split(",");
		var split_gabung_bulan = gabung_bulan.split(",");
		
		var data = {
			labels: split_gabung_bulan,
			datasets: [
			{
				label: "Bulan",
				fillColor: "rgba(151,187,205,0.5)",
				strokeColor: "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data: split_gabung_pencapaian_bulanan
			}
			]
		};

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#barChart").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var barChart = new Chart(ctx).Bar(data, options);
		;
		//generate the legend
		var legend = barChart.generateLegend();
		//and append it to your page somewhere
		$('#barLegend').append(legend);
	};
	
	
	
	var lineChartHandler1 = function() {
		var options = {
			// Sets the chart to be responsive
			responsive: true,

			///Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,

			//String - Colour of the grid lines
			scaleGridLineColor: 'rgba(0,0,0,.05)',

			//Number - Width of the grid lines
			scaleGridLineWidth: 1,

			//Boolean - Whether the line is curved between points
			bezierCurve: false,

			//Number - Tension of the bezier curve between points
			bezierCurveTension: 0.4,

			//Boolean - Whether to show a dot for each point
			pointDot: true,

			//Number - Radius of each point dot in pixels
			pointDotRadius: 4,

			//Number - Pixel width of point dot stroke
			pointDotStrokeWidth: 1,

			//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
			pointHitDetectionRadius: 20,

			//Boolean - Whether to show a stroke for datasets
			datasetStroke: true,

			//Number - Pixel width of dataset stroke
			datasetStrokeWidth: 2,

			//Boolean - Whether to fill the dataset with a colour
			datasetFill: true,

			// Function - on animation progress
			onAnimationProgress: function() {
			},

			// Function - on animation complete
			onAnimationComplete: function() {
			},

			//String - A legend template
			legendTemplate: '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
		};
		
	//	var target_ss = target_sudi +","+
		
		var ss = new Array("SUDI", "INDRA", "IBNU", "ZAIN", "WIN", "HENRI", "TIKO");
	
		
	//	var tgt = new Array("20", "35","13","42","30","54","66");
	//	var res = new Array("50", "25","33","62","49","37","72");
		
		var dd = kdspv.toString();
		var d = dd.trim();
		var dat = d.split(",");
		
		var dd1 = tgt_ss.toString();
		var d1 = dd1.trim();
		var dat1 = d1.split(",");
		
		var dd2 = res_ss.toString();
		var d2 = dd2.trim();
		var dat2 = d2.split(",");
	//	console.log(dat2[0]);
		
		var warna = ['151,187,205', '33, 171, 178', '180, 31, 193'];
	//	console.log(warna[2]);
	//	var mjj = brio.substring(1,1);
	//	console.log(mjj);
		
		var data1 = {
		//	labels: ["SUDI", "INDRA", "IBNU", "ZAIN", "WIN", "HENRI", "TIKO"],
			labels: dat,
			datasets: [{
				label: "Target",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
			//	data: [target_sudi, target_indra, target_ibnu, target_zain, target_wind, target_henri, target_tiko]
				data: dat1
			}, {
				label: "Result",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
			//	data: [result_sudi, result_indra, result_ibnu, result_zain, result_wind, result_henri, result_tiko]
				data: dat2
			}]
		};

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#lineChart1").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var lineChart1 = new Chart(ctx).Line(data1, options);
		//generate the legend
		var legend = lineChart1.generateLegend();
		//and append it to your page somewhere
		$('#lineLegend1').append(legend);
	};
	
	var barChartHandlerKomparansi = function() {
		var options = {
			
			// Sets the chart to be responsive
			responsive: true,

			//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			scaleBeginAtZero: true,

			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,

			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",

			//Number - Width of the grid lines
			scaleGridLineWidth: 1,

			//Boolean - If there is a stroke on each bar
			barShowStroke: true,

			//Number - Pixel width of the bar stroke
			barStrokeWidth: 2,

			//Number - Spacing between each of the X value sets
			barValueSpacing: 5,

			//Number - Spacing between data sets within X values
			barDatasetSpacing: 1,

			//String - A legend template
			legendTemplate: '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
		};
		
		var dd = kdspv.toString();
		var d = dd.trim();
		var dat = d.split(",");
		
		var dd1 = tgt_ss.toString();
		var d1 = dd1.trim();
		var dat1 = d1.split(",");
		var datadat = dat1.length;
		
		var dd2 = res_ss.toString();
		var d2 = dd2.trim();
		var dat2 = d2.split(",");
		var warna = ['rgba(151,187,205, 0.5)', 'rgba(33, 171, 178, 0.5)', 'rgba(164, 249, 220, 0.5)', 'rgba(245, 166, 252, 0.5)', 'rgba(25, 173, 12, 0.5)'];
		var visibility = ['0.5', '0.8'];
		var clr = ["rgba(151,187,205,0.5)", "rgba(33, 171, 178, 0.5)"];
		var i;
	//	var clr2 = clr.length;
		for(i = 0; i <= clr.length; i++){
		//	console.log(clr[i]);
		
		var data = {
			labels: dat,
			datasets: [
		
		/*	{
			//	backgroundColor: ['151,187,205', '33, 171, 178', '164, 249, 220', '245, 166, 252', '25, 173, 12'];
				label: "Tipe Mobil",

				fillColor: "rgba(33, 171, 178, 0.5)",
				strokeColor: "rgba(33, 171, 178,0.8)",
				highlightFill: "rgba(33, 171, 178,0.75)",
				highlightStroke: "rgba(33, 171, 178,1)",
			//	data: ['18', '05', '96', '22', '03', '96', '40']
			},	*/
		
		/*	{
				labels: dat1,
				datasets: [	*/
					{
						label: "TARGET",
					/*	
						fillColor: "rgba(151,187,205,0.5)",
						strokeColor: "rgba(151,187,205,0.8)",
						highlightFill: "rgba(151,187,205,0.75)",
						highlightStroke: "rgba(151,187,205,1)",
						*/
						
						fillColor: clr[0],
						strokeColor: "rgba(151,187,205,0.8)",
						highlightFill: "rgba(151,187,205,0.75)",
						highlightStroke: "rgba(151,187,205,1)",
						data: dat2
					},
				/*	{
						label: "RESULT",
						fillColor: "rgba(33, 171, 178, 0.5)",
						strokeColor: "rgba(33, 171, 178,0.8)",
						highlightFill: "rgba(33, 171, 178,0.75)",
						highlightStroke: "rgba(33, 171, 178,1)",
						data: dat2
					}	*/
		/*		]
			}	*/
			]
		};

		}		
		
		
		
	

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#lineChart1").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var barChart = new Chart(ctx).Bar(data, options);
		
		;
		//generate the legend
		var legend = barChart.generateLegend();
		//and append it to your page somewhere
		$('#lineLegend1').append(legend);
	};
	
	
	//===========================================================================================================================//
	//===========================================================================================================================//
	//===========================================================================================================================//
	//===========================================================================================================================//
	
	var barChartHandlerKomparansi2 = function() {
		
	/*	var options = {

			// Sets the chart to be responsive
			responsive: true,

			//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			scaleBeginAtZero: true,

			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,

			//String - Colour of the grid lines
			scaleGridLineColor: "rgba(0,0,0,.05)",

			//Number - Width of the grid lines
			scaleGridLineWidth: 1,

			//Boolean - If there is a stroke on each bar
			barShowStroke: true,

			//Number - Pixel width of the bar stroke
			barStrokeWidth: 2,

			//Number - Spacing between each of the X value sets
			barValueSpacing: 5,

			//Number - Spacing between data sets within X values
			barDatasetSpacing: 1,

			//String - A legend template
			legendTemplate: '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
		};
		
		
		var namaspv = {
			labels: nama,
			data: ["20", "35", "60", "20", "35", "60"],
			backgroundColor: 'rgba(99, 132, 0, 0.6)',
			borderWidth: 0,
			yAxisID: "y-axis-namaspv"
		}
		var spv = {
			labels: nama,
			data: ["123", "456","123", "456", "123", "456"],
			backgroundColor: 'rgba(0, 99, 132, 0.6)',
			borderWidth: 0,
			yAxisID: "y-axis-spv"
		}	*/
		
		
	/*	var lineChart = $("lineChart1");

		Chart.defaults.global.defaultFontFamily = "Lato";
		Chart.defaults.global.defaultFontSize = 18;

		var densityData = {
		  label: 'Density of Planet (kg/m3)',
		  data: [5427, 5243, 5514, 3933, 1326, 687, 1271, 1638],
		  backgroundColor: 'rgba(0, 99, 132, 0.6)',
		  borderWidth: 0,
		  yAxisID: "y-axis-density"
		};

		var gravityData = {
		  label: 'Gravity of Planet (m/s2)',
		  data: [3.7, 8.9, 9.8, 3.7, 23.1, 9.0, 8.7, 11.0],
		  backgroundColor: 'rgba(99, 132, 0, 0.6)',
		  borderWidth: 0,
		  yAxisID: "y-axis-gravity"
		};

		var planetData = {
		  labels: ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune"],
		  datasets: [densityData, gravityData]
		};

		var chartOptions = {
		  scales: {
			xAxes: [{
			  barPercentage: 1,
			  categoryPercentage: 0.6
			}],
			yAxes: [{
			  id: "y-axis-density"
			}, {
			  id: "y-axis-gravity"
			}]
		  }
		};

		var barChart = new Chart(chart, {
		  type: 'bar',
		  data: planetData,
		  options: chartOptions
		});
		
		
		var ctx = $("#lineChart1").get(0).getContext("2d");
		var barChart = new Chart(ctx).Line(lineChartData);	*/

		// Get context with jQuery - using jQuery's .get() method.
	/*	var ctx = $("#lineChart1").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var barChart = new Chart(ctx).Bar(data, options);
		
		;
		//generate the legend
		var legend = barChart.generateLegend();
		//and append it to your page somewhere
		$('#lineLegend1').append(legend);	*/
	};
	
/*	for (bar = 0; bar < 4; bar++) {
		y = [];
		barChartHandler.datasets.push({}); //create a new line dataset
		dataset = barChartData.datasets[bar]
		dataset.fillColor = "rgba(0,0,0,0)";
		dataset.strokeColor = "rgba(200,200,200,1)";
		dataset.data = []; //contains the 'Y; axis data

		for (x = 0; x < 10; x++) {
			y.push(bar + x); //push some data aka generate 4 distinct separate lines
			if (bar === 0)
				barChartData.labels.push(x); //adds x axis labels
		} //for x

		barChartData.datasets[line].data = y; //send new line data to dataset
	} //for line	*/

	
			

	return {
		//main function to initiate template pages
		init: function() {
			//barChartHandlerKomparansi();
			barChartHandler();
		//	lineChartHandler();
		//	lineChartHandler1();
			
			//barChartHandler2();
			//lineChartHandler2();
			//pieChartHandler();
			//doughnutChartHandler();
			
		}
		
	};
}();
