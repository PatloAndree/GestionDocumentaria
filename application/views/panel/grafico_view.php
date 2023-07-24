
<div class="card">

    <div class="col-md-7">
        <div id="chartdiv" style="width: 600px; height: 500px;"></div>
   </div> 
</div>


<script src="https://cdn.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://cdn.amcharts.com/lib/3/serial.js"></script>
<script src="https://cdn.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://cdn.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
<!-- <script src="https://cdn.amcharts.com/lib/3/maps/js/worldLow.js"></script> -->
<!-- <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script> --> 


<!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script> -->

<!-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script> -->


<link rel="stylesheet" src="https://www.amcharts.com/lib/3/plugins/export/export.css">




<script>
  
var chartData = JSON.parse(`<?php echo $chart_data; ?>`);
            try {
                  var chart = AmCharts.makeChart( "chartdiv", {
                  "type": "serial",
                  "theme":"light",
                  "dataProvider": chartData,
                  "valueAxes": [ {
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
                  } ],
                  "gridAboveGraphs": true,
                  "startDuration": 1,
                  "graphs": [ {
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "count"
                  } ],
                  "chartScrollbar": {
                "graph": "g1",
                "scrollbarHeight": 60,
                "backgroundAlpha": 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "graphLineAlpha": 0.5,
                "selectedGraphFillAlpha": 0,
                "selectedGraphLineAlpha": 1,
                "autoGridCount": true,
                "color": "#AAAAAA",
                "oppositeAxis": false
                                    },
                  "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
                  },
                  "categoryField": "date",
                  "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0,
                "tickPosition": "start",
                "tickLength": 20
                  },
                  "export": {
                "enabled": true
                  }
                } );          
            }
            catch( e ) {
              console.log( e );
            }

</script>