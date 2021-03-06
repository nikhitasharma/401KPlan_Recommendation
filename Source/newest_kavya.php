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
    */
$mpieChart1 = new FusionCharts("multilevelpie", "ex1" , 500, 500, "chart-1", "json", '{
      "chart": {
        "caption": "Types of Investments",
	  "renderAt":"chart-1",
        "subCaption": "Fixed vs Volatile",
        "numberPrefix": "%",
        "rotatevalues": "0",
        "showPercentInTooltip": "0",
       "baseFontColor" : "#333333",
                "baseFont" : "Helvetica Neue,Arial",   
                "basefontsize": "9",
                "subcaptionFontBold": "0",
                "bgColor" : "#ffffff",
                "canvasBgColor" : "#ffffff",
                "showBorder" : "0",
                "showShadow" : "0",
                "showCanvasBorder": "0",
                "pieFillAlpha": "60",
                "pieBorderThickness": "2",
                "hoverFillColor": "#cccccc",
                "pieBorderColor": "#ffffff",
                "useHoverColor": "1",
                "showValuesInTooltip": "1",
                "showPercentInTooltip": "0",
                "numberPrefix": "$",
                "plotTooltext": "$label, $$valueK, $percentValue"
      },
      "category": [
	  {
        "label": "Investments in total",
        "color": "#ffffff",
        "value": "100",
           "category": [
           {
               "label": "Fixed Income",
                "color": "#f8bd19",
                 "value": "40",
                  "category": [
                        {
                        "label": "Bonds",
                        "color": "#f8bd19",
                        "value": "20"
                        },
                        {
                         "label": "Mutual Funds",
                         "color": "#f8bd19",
                         "value": "10"
                                },
                        {
                         "label": "Direct Cash amenities",
                         "color": "#f8bd19",
                         "value": "5"
                                },
                        {
                         "label": "Gold",
                         "color": "#f8bd19",
                         "value": "5"
                                }
                        ]
            },
        "label": "Volatile Income",
        "color": "#008ee4",
        "value": "60",
           "category": [
           {
               "label": "Stocks",
                "color": "#008ee4",
                 "value": "60",
                  "category": [
                        {
                        "label": "Large Captial Stocks",
                        "color": "#008ee4",
                        "value": "20"
                        },
                        {
                         "label": "Small Capital Stocks",
                         "color": "#008ee4",
                         "value": "20"
                                },
                        {
                         "label": "Large Capital Value Funds",
                         "color": "#008ee4",
                         "value": "10"
                                },
                        {
                         "label": "International Stocks",
                         "color": "#008ee4",
                         "value": "10"
                                }
                        ]
                        
           }
           
                }
            ]
		
		}
		]
		}
		]
        
        
        
        <script>
        setTimeout(function() {
  
   url = '/assets.codepen.io/images/codepen-logo.svg';
   // downloadFile(url); // UNCOMMENT THIS LINE TO MAKE IT WORK
  
}, 2000);

// Source: http://pixelscommander.com/en/javascript/javascript-file-download-ignore-content-type/
window.downloadFile = function (sUrl) {

    //iOS devices do not support downloading. We have to inform user about this.
    if (/(iP)/g.test(navigator.userAgent)) {
       //alert('Your device does not support files downloading. Please try again in desktop browser.');
       window.open(sUrl, '_blank');
       return false;
    }

    //If in Chrome or Safari - download via virtual link click
    if (window.downloadFile.isChrome || window.downloadFile.isSafari) {
        //Creating new link node.
        var link = document.createElement('a');
        link.href = sUrl;
        link.setAttribute('target','_blank');

        if (link.download !== undefined) {
            //Set HTML5 download attribute. This will prevent file from opening if supported.
            var fileName = sUrl.substring(sUrl.lastIndexOf('/') + 1, sUrl.length);
            link.download = fileName;
        }

        //Dispatching click event.
        if (document.createEvent) {
            var e = document.createEvent('MouseEvents');
            e.initEvent('click', true, true);
            link.dispatchEvent(e);
            return true;
        }
    }

    // Force file download (whether supported by server).
    if (sUrl.indexOf('?') === -1) {
        sUrl += '?download';
    }

    window.open(sUrl, '_blank');
    return true;
}

window.downloadFile.isChrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
window.downloadFile.isSafari = navigator.userAgent.toLowerCase().indexOf('safari') > -1;
</script>
		
		
        
      
    }');
$mpieChart1->render();



?>
<div>
<div id="chart-1" >
   </div>


   
</div>
   
   
   
   <!-- Fusion Charts will render here-->
 

</body>
</html>