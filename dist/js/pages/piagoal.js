window.onload = function () {
 CanvasJS.addColorSet("piacolor",
	 [//colorSet Array

               "#00a65a",
			   "#00c0ef",
			   "#3c8dbc",
			   "#f56954",
                "#f39c12",
                "#d2d6de"
                ]);
	
var chart = new CanvasJS.Chart("piechart",
	{    
	
	    colorSet: "piacolor",
        animationEnabled: true, 
	
		data: [
		{        
			type: "doughnut",
			startAngle: 90,                          
			toolTipContent: "{legendText}: {y} - <strong>#percent% </strong>", 					
			showInLegend: true,
			dataPoints: [
				{y: 65899660, indexLabel: "", legendText: "" },
				{y: 60929152, indexLabel: "", legendText: "" },
				{y: 6175850,  indexLabel: "", legendText: "" },			
				{y: 21125850,  indexLabel: "", legendText: "" },	
				{y: 51125850,  indexLabel: "", legendText: "" },	
				{y: 31125850,  indexLabel: "", legendText: "" }	
			]
		}
		]
	});
	chart.render();

}