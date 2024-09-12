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
		var data = {
			labels: ["BRIO", "MOBILIO", "BR-V", "HR-V", "JAZZ", "CITY", "CIVIC", "CR-V", "ACCORD", "ODYSSEY"],
			datasets: [{
				label: "Tipe Mobil",
				fillColor: "rgba(151,187,205,0.5)",
				strokeColor: "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data: [brio, mobilio, brv, hrv, jazz, city, civic, crv, accord, odyssey]
			}]
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
	
	
	var lineChartHandler = function() {
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
		var data = {
			labels: ["SUDI", "INDRA", "IBNU", "ZAIN", "WIN", "HENRI", "WILDY"],
			datasets: [{
				label: "Target",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [target_sudi, target_indra, target_ibnu, target_zain, target_wind, target_henri, target_wildy]
			}, {
				label: "Result",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: [result_sudi, result_indra, result_ibnu, result_zain, result_wind, result_henri, result_wildy]
			}]
		};
		

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#lineChart2").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var lineChart = new Chart(ctx).Line(data, options);
		//generate the legend
		var legend = lineChart.generateLegend();
		//and append it to your page somewhere
		$('#lineLegend2').append(legend);
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
		console.log(dat2[0]);
		var data1 = {
		//	labels: ["SUDI", "INDRA", "IBNU", "ZAIN", "WIN", "HENRI", "TIKO"],
			labels: dat,
			datasets: [{
				label: "Penjualan Tunai Per Supervisor",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
			//	data: [target_sudi, target_indra, target_ibnu, target_zain, target_wind, target_henri, target_tiko]
				data: dat2
			}, {
				label: "Penjualan Asuransi Per Supervisor",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
			//	data: [result_sudi, result_indra, result_ibnu, result_zain, result_wind, result_henri, result_tiko]
				data: dat1
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
	
	
	var barChartHandler2 = function() {
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
		var data = {
			labels: ["Ari", "Ihsan", "Suherman", "Taufik", "Wahyu", "Yus"],
			datasets: [{
				label: "Plus - Plus",
				fillColor: "rgba(151,187,205,0.5)",
				strokeColor: "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data: [plus_ari, plus_ihsan, plus_suherman, plus_taufik, plus_wahyu, plus_yus]
			}]
		};

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#barChart2").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var barChart2 = new Chart(ctx).Bar(data, options);
		;
		//generate the legend
		var legend = barChart2.generateLegend();
		//and append it to your page somewhere
		$('#barLegend2').append(legend);
	};
	
	
	var lineChartHandler2 = function() {
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
			bezierCurve: true,

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
		var data = {
			labels: ["Ari", "Ihsan", "Suherman", "Taufik", "Wahyu", "Yus"],
			datasets: [{
				label: "Engine Oil",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [engineoil_ari, engineoil_ihsan, engineoil_suherman, engineoil_taufik, engineoil_wahyu, engineoil_yus]
			}]
		};

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#lineChart2").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var lineChart2 = new Chart(ctx).Line(data, options);
		//generate the legend
		var legend = lineChart2.generateLegend();
		//and append it to your page somewhere
		$('#lineLegend2').append(legend);
	};
	
	var pieChartHandler = function() {
		// Chart.js Data
		var data = [{
			value: tunai,
			color: '#F7464A',
			highlight: '#FF5A5E',
			label: 'PENJUALAN TUNAI'
		}, {
			value: kredit,
			color: '#46BFBD',
			highlight: '#5AD3D1',
			label: 'PENJUALAN ASURANSI'
		}];

		// Chart.js Options
		var options = {

			// Sets the chart to be responsive
			responsive: true,

			//Boolean - Whether we should show a stroke on each segment
			segmentShowStroke: true,

			//String - The colour of each segment stroke
			segmentStrokeColor: '#fff',

			//Number - The width of each segment stroke
			segmentStrokeWidth: 2,

			//Number - The percentage of the chart that we cut out of the middle
			percentageInnerCutout: 0, // This is 0 for Pie charts

			//Number - Amount of animation steps
			animationSteps: 100,

			//String - Animation easing effect
			animationEasing: 'easeOutBounce',

			//Boolean - Whether we animate the rotation of the Doughnut
			animateRotate: true,

			//Boolean - Whether we animate scaling the Doughnut from the centre
			animateScale: true,

			//String - A legend template
			legendTemplate: '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'

		};

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#pieChart").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var pieChart = new Chart(ctx).Pie(data, options);
		;
		//generate the legend
		var legend = pieChart.generateLegend();
		//and append it to your page somewhere
		$('#pieLegend').append(legend);
	};
	
	var doughnutChartHandler = function() {
		var data = [{
			value: mbf,
			color: '#F7464A',
			highlight: '#FF5A5E',
			label: 'MBF'
		}, {
			value: maf,
			color: '#46BFBD',
			highlight: '#5AD3D1',
			label: 'MAF'
		}, {
			value: bca,
			color: '#ff8533',
			highlight: '#ffb380',
			label: 'BCA'
		}, {
			value: may,
			color: '#4dff4d',
			highlight: '#99ff99',
			label: 'MAYBANK'
		}, {
			value: mtf,
			color: '#d966ff',
			highlight: '#ecb3ff',
			label: 'MTF'
		}, {
			value: other,
			color: '#ffff66',
			highlight: '#ffffb3',
			label: 'OTHERS'
		}];

		// Chart.js Options
		var options = {

			// Sets the chart to be responsive
			responsive: true,

			//Boolean - Whether we should show a stroke on each segment
			segmentShowStroke: true,

			//String - The colour of each segment stroke
			segmentStrokeColor: '#fff',

			//Number - The width of each segment stroke
			segmentStrokeWidth: 2,

			//Number - The percentage of the chart that we cut out of the middle
			percentageInnerCutout: 50, // This is 0 for Pie charts

			//Number - Amount of animation steps
			animationSteps: 100,

			//String - Animation easing effect
			animationEasing: 'easeOutBounce',

			//Boolean - Whether we animate the rotation of the Doughnut
			animateRotate: true,

			//Boolean - Whether we animate scaling the Doughnut from the centre
			animateScale: false,

			//String - A legend template
			legendTemplate: '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'

		};

		// Get context with jQuery - using jQuery's .get() method.
		var ctx = $("#doughnutChart").get(0).getContext("2d");
		// This will get the first returned node in the jQuery collection.
		var doughnutChart = new Chart(ctx).Doughnut(data, options);
		;
		//generate the legend
		var legend = doughnutChart.generateLegend();
		//and append it to your page somewhere
		$('#doughnutLegend').append(legend);
	};
	return {
		//main function to initiate template pages
		init: function() {
			
		//	barChartHandler();
		//	lineChartHandler();
			lineChartHandler1();
			//barChartHandler2();
			//lineChartHandler2();
			pieChartHandler();
		//	doughnutChartHandler();
			
		}
		
	};
}();
