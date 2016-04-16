 window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Oil Reserves and Production "    
      },
      axisY2: {
        title:"Production (bbl/day)"
      },
      animationEnabled: true,
      axisY: {
        title: "Reserves(MMbbl)"
      },
      axisX :{
        labelFontSize: 12,
	},
      legend: {
        verticalAlign: "bottom"
      },
      data: [

      {        
        type: "bar",  
        showInLegend: true, 
        legendText: "Reserves  in MMbbl",
        dataPoints: [      
        { x: 10, y: 267017,  label: "Saudi Arabia" },
        { x: 20, y: 116000,  label: "Russia"},
        { x: 30, y: 20682,  label: "US"},
        { x: 40, y: 154580,  label: "Iran"},
        { x: 50, y: 20350,  label: "China"},
        { x: 60, y: 175200,  label: "Canda"},
        { x: 70, y: 97800, label:"UAE"},
        { x: 80, y: 297571, label:"Venezuela"}


        ]
      },
      {        
        type: "bar",  
        axisYType: "secondary",
        showInLegend: true,
        legendText: "production in bbl/day",
        dataPoints: [      
        { x: 10, y:11150000, label: "Saudi Arabia" },
        { x: 20, y:10210000, label: "Russia"},
        { x: 30, y:9023000 , label: "US"},
        { x: 40, y:4231000 , label: "Iran"},
        { x: 50, y:4073000 , label: "China"},
        { x: 60, y:3592000, label: "Canda"},
        { x: 70, y:3087000, label:"UAE"},
        { x: 80, y:2453000, label:"Venezuela"}


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
          chart.render();
        }
      }
    });

chart.render();
}