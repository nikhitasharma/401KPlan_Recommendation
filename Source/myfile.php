
<!DOCTYPE html>
	  <?php
session_start();
if( isset($dat1) && ($dat1!=null) && isset($dat2) && ($dat2!=null)  )
{
$dat1=$_SESSION['YourAge'];
$dat2=$_SESSION['RetirementAge'];
}
else
{
 $dat1="20";
 $dat2="60";
}
/* Include the `fusioncharts.php` file that contains functions	to embed the charts. */

   include("fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */

   $hostdb = "localhost";  // MySQl host
   $userdb = "root";  // MySQL username
   $passdb = "";  // MySQL password
   $namedb = "total";  // MySQL database name

   // Establish a connection to the database
   $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);

   /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
   if ($dbhandle->connect_error) {
  	exit("There was an error with your connection: ".$dbhandle->connect_error);
   }
  
?>

<html>
<head>
	 <center> <h1><font color="grey">401K RECOMMENDATIONS FOR YOU</h1></center></font>
<link href="css/extension-page-style.css" rel="stylesheet" type="text/css"  />

<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>


<script>
	  FusionCharts.ready(function () {
    var stockPriceChart = new FusionCharts({
       id: "stackRealTimeChart",
        type: 'realtimestackedcolumn',
        renderAt: 'chart-container',
        width: '500',
        height: '300',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Live Investment Data",
                "subCaption": "Bonds and Stocks",
                "xAxisName": "Time",
                "yAxisName": "Percent Change",
                "refreshinterval": "5",
                "numberSuffix":"%",
                "yaxisminvalue": "0",
                "yaxismaxvalue": "100",
                "numdisplaysets": "10",
                "labeldisplay": "rotate",
                "showValues": "1",
                "showRealTimeValue": "0",
                
                //Cosmetics
                "paletteColors" : "#0075c2,#1aaf5d",
                "baseFontColor" : "#333333",
                "baseFont" : "Helvetica Neue,Arial",
                "captionFontSize" : "14",
                "subcaptionFontSize" : "14",
                "subcaptionFontBold" : "0",
                "showBorder" : "0",
                "bgColor" : "#ffffff",
                "showShadow" : "0",
                "usePlotGradientColor" :"0",
                "showPlotBorder": "0",
                "valueFontColor" : "#ffffff",
                "placeValuesInside" : "1",
                "canvasBgColor" : "#ffffff",
                "canvasBorderAlpha" : "0",
                "divlineAlpha" : "100",
                "divlineColor" : "#999999",
                "divlineThickness" : "1",
                "divLineIsDashed" : "1",
                "divLineDashLen" : "1",
                "divLineGapLen" : "1",
                "showXAxisLine" : "1",
                "xAxisLineThickness" : "1",
                "xAxisLineColor" : "#999999",
                "showAlternateHGridColor" : "0",
                "legendBgAlpha" : "0",
                "legendBorderAlpha" : "0",
                "legendShadow" : "0",
                "legendItemFontSize" : "10",
                "legendItemFontColor" : "#666666"

            },
            "categories": [
                {
                    "category": [
                        { "label": "" }
                    ]
                }
            ],
           "dataset": [
                {
                    "seriesName" : "Bonds",
                    "data": [
                        { "value": "40" }
                    ]
                },
                {
                    "seriesName" : "Stocks",
                    "data": [
                        { "value": "20" }
                    ]
                }
            ]
        },
        "events": {
            "initialized": function (e) {
                function addLeadingZero(num){
                    return (num <= 19)? ("0"+num) : num;
                }
                function updateData() {
                    // Get reference to the chart using its ID
                    var chartRef = FusionCharts("stackRealTimeChart"),
                        // We need to create a querystring format incremental update, containing
                        // label in hh:mm:ss format
                        // and a value (random).
                        currDate = new Date(),
                        label = addLeadingZero(currDate.getHours()) + ":" +
                        addLeadingZero(currDate.getMinutes()) + ":" +
                        addLeadingZero(currDate.getSeconds()),
                        // Get random number between 20 & 38 - rounded to 2 decimal places
                        randomValue2 = parseInt(Math.random()     
                                                 * 15 )  + 20,
                        randomValue = 40,
                        // Build Data String in format &label=...&value=...
                        strData = "&label=" + label 
                    + "&value=" 
                    + randomValue+ "|" + randomValue2;
                    // Feed it to chart.
                    chartRef.feedData(strData);
                }
                
                var myVar = setInterval(function () {
                    updateData();
                }, 1000);
            }
        }
    })
    .render();
});
</script>
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
include 'import.php';
echo "<center>";     
     	$strQuery = "SELECT year, price FROM hack ORDER BY year";
		
     	// Execute the query, or else return the error message.
     	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
       
     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "401K ANALYSIS",
				  "subCaption"=> "yearly amount",
                "xAxisName"=> "Year",
                "yAxisName"=> "Total Amount (In USD)",
                "numberPrefix"=> "$",
                "paletteColors"=> "#dc143c",
                "bgColor"=> "#ffffff",
                "showBorder"=> "0",
                "showCanvasBorder"=> "0",
                "plotBorderAlpha"=> "10",
                "usePlotGradientColor"=> "0",
                "plotFillAlpha"=> "100",
                "showXAxisLine"=> "1",
                "axisLineAlpha"=> "25",
                "divLineAlpha"=> "10",
                "showValues"=> "0",
                "showAlternateHGridColor"=> "0",
                "captionFontSize"=> "14",
                "subcaptionFontSize"=> "14",
                "subcaptionFontBold"=> "0",
                "toolTipColor"=> "#ffffff",
                "toolTipBorderThickness"=> "0",
                "toolTipBgColor"=> "#000000",
                "toolTipBgAlpha"=> "80",
                "toolTipBorderRadius"=> "2",
                "toolTipPadding"=> "5"
              	)
           	);

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
              	"label" => $row["year"],
              	"value" => $row["price"]
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("area2d", "myFirstChart" , 700, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	//// Close the database connection
        	//$dbhandle->close();
     	}
?>
<?php
/**
* This example describes the single seriese chart preparation using FusionCharts PHP wrapper
*/
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
    */
	
$pieChart1 = new FusionCharts("doughnut2d", "ex1" , "100%", 400, "chart-2", "json", '{
      "chart": {
        "caption": "Investment Plan",
	  "renderAt":"chart-2",
        "subCaption": "1 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
		"paletteColors": "#f45b00,#1aaf5d,#f2c500,#ce55f92,#0075c2",
        "showPercentInTooltip": "0",
       "decimals": "1",
         "bgColor": "#ffffff",
                "showBorder": "0",
                "use3DLighting": "0",
                "showShadow": "0",
                "enableSmartLabels": "0",
                "startingAngle": "310",
                "showLabels": "0",
                "showPercentValues": "1",
                "showLegend": "1",
                "legendShadow": "20",
                "legendBorderAlpha": "0",
                "defaultCenterLabel": "Total revenue",
                "centerLabel": "Revenue from $label: $value",
                "centerLabelBold": "1",
                "showTooltip": "0",
                "decimals": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0"
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

$pieChart2 = new FusionCharts("doughnut2d", "ex2" , "100%", 400, "chart-3", "json", '{
      "chart": {
        "caption": "Investment Plan",
	   "renderAt":"chart-3",
        "subCaption": "5 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "decimals": "1",
	   	"paletteColors": "#f45b00,#1aaf5d,#f2c500,#ce55f92,#0075c2",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "use3DLighting": "0",
                "showShadow": "0",
                "enableSmartLabels": "0",
                "startingAngle": "310",
                "showLabels": "0",
                "showPercentValues": "1",
                "showLegend": "1",
                "legendShadow": "20",
                "legendBorderAlpha": "0",
                "defaultCenterLabel": "Total revenue",
                "centerLabel": "Revenue from $label: $value",
                "centerLabelBold": "1",
                "showTooltip": "0",
                "decimals": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0"
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

$pieChart3 = new FusionCharts("doughnut2d", "ex3" , "100%", 400, "chart-4", "json", '{
      "chart": {
        "caption": "Investment Plan",
	   "renderAt":"chart-4",
        "subCaption": "10 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "decimals": "1",
        "bgColor": "#ffffff",
		"paletteColors": "#f45b00,#1aaf5d,#f2c500,#ce55f92,#0075c2",
                "showBorder": "0",
                "use3DLighting": "0",
                "showShadow": "0",
                "enableSmartLabels": "0",
                "startingAngle": "310",
                "showLabels": "0",
                "showPercentValues": "1",
                "showLegend": "1",
                "legendShadow": "20",
                "legendBorderAlpha": "0",
                "defaultCenterLabel": "Total revenue",
                "centerLabel": "Revenue from $label: $value",
                "centerLabelBold": "1",
                "showTooltip": "0",
                "decimals": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0"
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

$pieChart4 = new FusionCharts("pie2d", "ex4" , "100%", 400, "chart-5", "json", '{
      "chart": {
        "caption": "Investment Plan
	   "renderAt":"chart-5",
        "subCaption": "20 year",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "decimals": "1",
         "bgColor": "#ffffff",
                "showBorder": "0",
                "use3DLighting": "0",
                "showShadow": "0",
                "enableSmartLabels": "0",
                "startingAngle": "310",
                "showLabels": "0",
                "showPercentValues": "1",
                "showLegend": "1",
                "legendShadow": "0",
                "legendBorderAlpha": "0",
                "defaultCenterLabel": "Total revenue: $64.08K",
                "centerLabel": "Revenue from $label: $value",
                "centerLabelBold": "1",
                "showTooltip": "0",
                "decimals": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0"
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
	  <div id="chart-container" style="display:inline-block;height:300px">FusionCharts will render here</div>
	  
<div id="chart-1" style="display:inline-block;width:50%;height:300px" >
   </div>
</div>
<div id="chart-2"  style="display:inline-block;width:33%;height:250px">
   </div>

   <div id="chart-3" style="display:inline-block;width:33%;height:250px">
   </div>
   
   <div id="chart-4" style="display:inline-block;width:33%;height:250px" float="left">
   </div>
   
    <div id="chart-4" style="display:inline-block;width:33%;height:250px" float="left">
   </div>
   
   
   
   
   <!-- Fusion Charts will render here-->
 

</body>
</html>