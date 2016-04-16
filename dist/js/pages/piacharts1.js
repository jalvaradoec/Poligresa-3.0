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

	var chart1 = new CanvasJS.Chart("piechart1",
	{
	   colorSet: "piacolor",
          animationEnabled: true,     
		data: [
		{        
			type: "doughnut",
			startAngle: 60,                          
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
	chart1.render();
	var chart2 = new CanvasJS.Chart("piechart2",
	{
	    colorSet: "piacolor",
	     animationEnabled: true,     
		data: [
		{        
			type: "doughnut",
			startAngle: 60,                          
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
	chart2.render();
	
	
	//  bar Chart 
var chart3 = new CanvasJS.Chart("chartContainer",
    {
	colorSet: "piacolor",
    animationEnabled: true,
    
      legend: {
        verticalAlign: "bottom"
      },
      data: [

      {        
        type: "bar",  
        showInLegend: true, 
        legendText: "",
        dataPoints: [      
        { x: 10, y: 267017,  label: "" },
        { x: 20, y: 116000,  label: ""}
      
        ]
      },
      {        
        type: "bar",  
        axisYType: "secondary",
        showInLegend: true,
        legendText: "",
        dataPoints: [      
        { x: 10, y:11150000, label: "" },
        { x: 20, y:10210000, label: ""}



        ]
      }

      ],
      legend: {
        cursor:"pointer",
        itemclick : function(e){
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else{
            e.dataSeries.visible = true;
          }
          chart3.render();
        }
      }
    });

chart3.render();

var chart4 = new CanvasJS.Chart("chartContainer1",
    {
	colorSet: "piacolor",
    animationEnabled: true,
    
      legend: {
        verticalAlign: "bottom"
      },
      data: [

      {        
        type: "bar",  
        showInLegend: true, 
        legendText: "",
        dataPoints: [      
        { x: 10, y: 267017,  label: "" },
        { x: 20, y: 116000,  label: ""}
      
        ]
      },
      {        
        type: "bar",  
        axisYType: "secondary",
        showInLegend: true,
        legendText: "",
        dataPoints: [      
        { x: 10, y:11150000, label: "" },
        { x: 20, y:10210000, label: ""}



        ]
      }

      ],
      legend: {
        cursor:"pointer",
        itemclick : function(e){
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else{
            e.dataSeries.visible = true;
          }
          chart4.render();
        }
      }
    });

chart4.render();

}