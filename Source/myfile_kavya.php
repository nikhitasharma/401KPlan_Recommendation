
<!DOCTYPE html>
<html>
<head>
<link href="css/extension-page-style.css" rel="stylesheet" type="text/css"  />

<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>


<style>

.code-block-holder pre {
      max-height: 188px;  
      min-height: 188px; 
      overflow: auto;
      border: 1px solid #ccc;
      border-radius: 5px;
}


.tab-btn-holder {
	width: 100%;
	margin: 20px 0 0;
	border-bottom: 1px solid #dfe3e4;
	min-height: 30px;
}

.tab-btn-holder a {
	background-color: #fff;
	font-size: 14px;
	text-transform: uppercase;
	color: #006bb8;
	text-decoration: none;
	display: inline-block;
	*zoom:1; *display:inline;


}

.tab-btn-holder a.active {
	color: #858585;
    padding: 9px 10px 8px;
    border: 1px solid #dfe3e4;
    border-bottom: 1px solid #fff;
    margin-bottom: -1px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    position: relative;
    z-index: 300;
}

</style>

</head>
<body>
<?php

/**
* This example describes the single seriese chart preparation using FusionCharts PHP wrapper
*/

include("fusioncharts.php");
// Including the wrapper file in the page
//include("../src/fusioncharts.php");


	// Preparing the object of FusionCharts with needed informations
    /**
    * The parameters of the constructor are as follows
    * chartType   {String}  The type of chart that you intend to plot. e.g. Column3D, Column2D, Pie2D etc.
    * chartId     {String}  Id for the chart, using which it will be recognized in the HTML page. Each chart on the page should have a unique Id.
    * chartWidth  {String}  Intended width for the chart (in pixels). e.g. 400
    * chartHeight {String}  Intended height for the chart (in pixels). e.g. 300
    * containerId {String}  The id of the chart container. e.g. chart-1
    * dataFormat  {String}  Type of data used to render the chart. e.g. json, jsonurl, xml, xmlurl
    * dataSource  {String}  Actual data for the chart. e.g. {"chart":{},"data":[{"label":"Jan","value":"420000"}]}
    * 
    */
    
    
$pieChart1 = new FusionCharts("pie2d", "ex1" , "100%", 400, "chart-1", "json", '{
      "chart": {
        "caption": "Investment Plan",
	  "renderAt":"chart-1",
        "subCaption": "1 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "decimals": "1",
        "theme": "fint"
      },
      "data": [
	  {
        "label": "Stocks",
        "value": "70"
      }, {
        "label": "Bonds",
        "value": "10"
      }, {
        "label": "Cash",
        "value": "5"
      }, {
        "label": "Mutual Funds",
        "value": "5"
      }, {
        "label": "Other Investments",
        "value": "10"
      }]
    }');
$pieChart1->render();
$pieChart2 = new FusionCharts("pie2d", "ex2" , "100%", 400, "chart-2", "json", '{
      "chart": {
        "caption": "Investment Plan",
	   "renderAt":"chart-2",
        "subCaption": "5 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "decimals": "1",
        "theme": "fint"
      },
      "data": [
	  {
        "label": "Stocks",
        "value": "60"
      }, {
        "label": "Bonds",
        "value": "20"
      }, {
        "label": "Cash",
        "value": "5"
      }, {
        "label": "Mutual Funds",
        "value": "5"
      }, {
        "label": "Other Investments",
        "value": "10"
      }]
    }');
$pieChart2->render();
$pieChart3 = new FusionCharts("pie2d", "ex3" , "100%", 400, "chart-3", "json", '{
      "chart": {
        "caption": "Investment Plan",
	   "renderAt":"chart-3",
        "subCaption": "10 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "decimals": "1",
        "theme": "fint"
      },
      "data": [
	  {
        "label": "Stocks",
        "value": "40"
      }, {
        "label": "Bonds",
        "value": "40"
      }, {
        "label": "Cash",
        "value": "5"
      }, {
        "label": "Mutual Funds",
        "value": "5"
      }, {
        "label": "Other Investments",
        "value": "10"
      }]
    }');
$pieChart3->render();
$pieChart4 = new FusionCharts("pie2d", "ex4" , "100%", 400, "chart-4", "json", '{
      "chart": {
        "caption": "Investment Plan
	   "renderAt":"chart-4",
        "subCaption": "20 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "decimals": "1",
        "theme": "fint"
      },
      "data": [
	  {
        "label": "Stocks",
        "value": "20"
      }, {
        "label": "Bonds",
        "value": "60"
      }, {
        "label": "Cash",
        "value": "5"
      }, {
        "label": "Mutual Funds",
        "value": "5"
      }, {
        "label": "Other Investments",
        "value": "10"
      }]
    }');

$pieChart4->render();
?>
<div>
    <div style="display:inline-block;width:50%">
	<div id="chart-1" style="display:inline-flex;height:40%" >
   </div>

<div id="chart-2"  style="display:inline-flex;height:50%">
   </div>
	
    </div>
<div style="display:inline-block;width:50%" >


   <div id="chart-3" style="display:inline-flex;height:40%">
   </div>
   
   <div id="chart-4" style="display:inline-flex;height:40%">
   </div>
   
</div>
</div>
   
   
   
   <!-- Fusion Charts will render here-->
 

</body>
</html>