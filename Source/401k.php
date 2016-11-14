<?php

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
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
   
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>401 K Plan Analysis</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

    <meta charset="utf-8"/>

   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js" type="text/javascript"></script>
    <script src="chartist-plugin-axistitle.js" type="text/javascript"></script>
	<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="generator" content="NoteTab Light 4.9">
 

<meta name="description" content="">
<meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>



<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>


<style>



</style>

<style>
#grad1 {
    height: 20px;
    width: 50px
     background: -webkit-linear-gradient(left, green, yellow, orange, red ); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(left, green, yellow, orange, red); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(left, green, yellow, orange, red); /* For Fx 3.6 to 15 */
    background: linear-gradient(to right, green, yellow, orange, red); /* Standard syntax (must be last) */
}
</style>


<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}
</script>

<script>
function myFunction() {
    alert("I am an alert box!");
}
</script>
<script language="javascript" type="text/javascript" src="datetimepicker.js">
</script>
    <script>
function validate(){
            var age = document.getElementById("YourAge").value;
            var rage = document.getElementById("RetirementAge").value;
            var inc = document.getElementById("Income").value;
            var con = document.getElementById("Contribution").value;
            var bal = document.getElementById("Balance").value;
            var ret = document.getElementById("Return").value;
            var goal = document.getElementById("goal").value;
            var risk = document.getElementById("risk").value;
            
            if ( (age == "") || (rage == "") || (inc == "") || (con == "") || (bal == "") || (ret == "") ||(goal == "") || (risk == "") )
            {
              alert("Please enter all required fields");
              
            }
}
    function recommend_goal(){
            var your_age = Number(document.getElementById("YourAge").value);
                var retire_age = Number(document.getElementById("RetirementAge").value);
            var num_years = retire_age - your_age;
            if (num_years > 30)
            {
              document.getElementById("msg1").innerHTML=" We suggest you to choose an aggresive plan to maximize your profits";
              document.getElementById("goal").value = "a" ;
            }
            else if(num_years > 10 && num_years <=30 )
            {
              document.getElementById("msg1").innerHTML=" We suggest you to choose a moderate plan to get optimum profits";
               document.getElementById("goal").value = "m" ;
                }
                else if(num_years <= 10)
            {
              document.getElementById("msg1").innerHTML=" We suggest you to choose a safest plan to prevent losses";
              document.getElementById("goal").value = "s" ;
                }
    }

    function recommend_risk(){
            var selectedgoal = document.getElementById("goal").value;
            
            if (selectedgoal == "a")
            {
              document.getElementById("msg2").innerHTML="We suggest you to choose higher risk level to maximize your profits";
              document.getElementById("risk").value = "80" ;
              document.getElementById("risk_percent").value = "80" ;
            }
            else if(selectedgoal == "m")
            {
              document.getElementById("msg2").innerHTML=" We suggest you to choose moderate risk levels to get optimum profits";
               document.getElementById("risk").value = "60" ;
              document.getElementById("risk_percent").value = "60" ;
                }
                else if(selectedgoal == "s")
            {
              document.getElementById("msg2").innerHTML=" We suggest you to choose lower risk level to prevent losses";
               document.getElementById("risk").value = "30" ;
              document.getElementById("risk_percent").value = "30" ;
                }
    }

            

      var btn = document.getElementById("Calculate");
      function calculate() {
         var income = Number(document.getElementById("Income").value);
		 var your_age = Number(document.getElementById("YourAge").value);
		 var retire_age = Number(document.getElementById("RetirementAge").value);
		 var increase = Number(document.getElementById("Increase").value);
		 var curr_balance = Number(document.getElementById("Balance").value);
		 var contribution = Number(document.getElementById("Contribution").value);
		 var exp_return = Number(document.getElementById("Return").value);
		 // Find number of years required
		 var num_years = retire_age - your_age;
		 // Make array of income and contribution each year
		var income_arr = [];
		var contr_arr = [];
		var balance_arr = [];
		var interest_arr = [];
		income_arr[0] = income;
		contr_arr[0] = income * (contribution / 100);
		interest_arr[0] = curr_balance * (increase / 100);
		balance_arr[0] = curr_balance + contr_arr[0] + interest_arr[0];
		for(i = 1; i < num_years; i++)
		{
			var prev_income = income_arr[i-1];
			income_arr[i] = prev_income + (prev_income * (increase / 100));
			contr_arr[i] = income_arr[i] * (contribution / 100);
			interest_arr[i] = balance_arr[i-1] * (exp_return / 100);
			balance_arr[i] = balance_arr[i-1] + interest_arr[i] + contr_arr[i]
		}
    // Make array for years
    var years = []
    for(i = 0; i < num_years; i++)
    {
        years[i] = i;
    }
    // Make Chart
  
  var hiddenElement = document.createElement('a');
hiddenElement.href = 'data:attachment/csv,' + encodeURI(string)  ;
hiddenElement.target = '/';
hiddenElement.download = 'myFile.csv';
hiddenElement.click();


/*	new Chartist.Bar('.ct-chart', {
      labels: years,
      series: [balance_arr]
    }, {
      low: 0,
      showArea: true
    });*/
         document.getElementById("Output").innerHTML = "401K Balance After " + num_years + " years: $" + balance_arr[num_years - 1].formatMoney(2);
      }
	Number.prototype.formatMoney = function(c, d, t){
	var n = this,
    c = isNaN(c = Math.abs(c)) ? 2 : c,
    d = d == undefined ? "." : d,
    t = t == undefined ? "," : t,
    s = n < 0 ? "-" : "",
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

    // Make Chart
    // Initialize a Line chart in the container with the ID chart1
    </script>

    <title>401K Calculator</title>
  </head>

 <body >
<p style="font-family: Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif;"> 
<header>
    <div class="">
     
 <center><strong><h1 class="title" style="background:#2d5986;"><a><font color="white">401K INVESTMENT PLAN ANALYTICS</font></a></h1> </center></strong></p></div></header>
	<div >
	<div style="width:50%; float:left">
	<div id="form_container" >


		<form id="form_3749" class="appnitro"  method="post" action="myfile.php">
					<div class="form_description">
					 <br>
			<center><h2 style="font-size:180%;background:#2d5986"><font color="white"> PLAN RECOMMENDATION FORM </font> </h2>
			<p><strong>Please provide below information in order for us to serve you</strong></p></center>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Name </label>
		<span>
			<input id="element_1_1" name= "element_1_1" class="element text" maxlength="255" size="14" value=""/>
			<label>First</label>
		</span>
		<span>
			<input id="element_1_2" name= "element_1_2" class="element text " maxlength="255" size="14" value=""/>
			<label>Last</label>
		</span> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5" >Age </label>
		<div class="div">
			<input id="YourAge" value="20" required="required" onchange="validate();recommend_goal();calculate()" name="element_5" height="20px" class="element text medium" type="text" maxlength="255" /> 
		<span class="asterisk_input">  </span> 
    </div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Retirement Age </label>
		<div class="div">
			<input value="60"  onchange="recommend_goal();calculate()" required="required" id="RetirementAge" required="required" name="retage" class="element text medium" type="text" maxlength="255" /> 
		<span class="asterisk_input">  </span> 
    </div> 

		</li>		<li id="li_8" >
		<label class="description" for="element_8">Salary </label>
		<span class="symbol">$</span> 
		<span>
			<input id="Income" onchange="calculate()" value="20000" name="sal" required="required" class="element text currency" size="10"  type="text" />   .		
			<label for="element_8_1">Dollars</label> 
		</span>
		<span>
			<input id="element_8_2" name="element_8_2" class="element text" size="2" maxlength="2" value="" type="text" /> <span class="asterisk_input2">  </span>
			<label for="element_8_2">Cents</label>
		</span>
		 
		</li>		<li id="li_9" >
		<label class="description" for="element_9">Salary Hike </label>
		<span class="symbol">$</span>
		<span>
			<input id="element_9_1" id="Increase" onchange="calculate()"  name="hike" class="element text currency" size="10" value="" type="text" /> .		
			<label for="element_9_1">Percent</label>
		</span>
		
		 
		</li>		<li id="li_7" >
     <label class="description" for="element_4">Salary Percentage to 401K Plan </label>
		<div>
			<input id="Contribution" onchange="calculate()" required="required"  name="salpercent" class="element text medium" type="text" maxlength="255" value="5"/> 
		<span class="asterisk_input">  </span> </div> 
		<label class="description" for="element_7">Current 401k Balance </label>
		<div>
			<input onchange="calculate()" id="Balance" value="10"  required="required" name="currbal" class="element text medium" type="text" maxlength="255" /> 
		<span class="asterisk_input">  </span>
    </div> 
		
    
        <label class="description" for="element_4">Expected Annual Return Percent </label>
		<div>
			<input id="Return" value="10" onchange="calculate()" required="required"  name="return" class="element text medium" type="text" maxlength="255" /> 
		<span class="asterisk_input">  </span> </div> 
     <label class="description" for="element_4">Company Match </label>
		<div>
			<input id="match" name="element_4" class="element text medium" onchange="calculate()" type="text" required="required" maxlength="255" value="0"/> 
		</div> 
     <label class="description" for="element_4">Max match percent</label>
		<div>
			<input id="maxmatch" name="element_4" onchange="calculate()" class="element text medium" type="text" maxlength="255" value="10"/> 
		</div> 
      
		
		<label class="description" for="element_10">Desired Goal </label>
		<div>
		<select class="element select medium" id="goal"  onchange="recommend_risk();calculate()" required="required" name="goal"> 
<option value="e"> select an option </option>
<option value="a" >Aggressive Plan</option>
<option  value="m" >Moderate Plan</option>
<option value="s" >Safe Plan</option>

		</select>
    <span class="asterisk_input">  </span>
    <span id="msg1" style="color:purple"></span>
		</div> 
<br>
     <label class="description" for="element_4">Risk</label>
		<div>
			<input id="risk" name="risk" value="60" class="element text medium" type="text" maxlength="255" required="required" onchange='document.getElementById("risk").value =  document.getElementById("risk_percent").value;'/> 
		</div> 
    
<div style="width:250px;height=1px;float:left" id="grad1" style="text-align:center;margin:auto;color:#888888;font-size:5px;font-weight:bold">

<input style="width:250px" type="range" min="1" max="100" step="1" value="60"  id="risk_percent" name="riskpercent" onchange='document.getElementById("risk").value =  document.getElementById("risk_percent").value;' />

</div>
<span id="msg2" style="color:purple"></span>

		</li>
    
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="3749" />
			    
			
	   	<input style="height:50px;background-color:teal;float:right" id="saveForm" class="button_text" type="submit" name="submit" value="VIEW RECOMMENDED" />
	
	 	<input style="height:50px;background-color:teal;float:left" id="saveForm" class="button_text" type="submit" name="submit" value="SUBMIT" />
	
		</li>
					
			</ul>
		</form>	
		<div id="footer">
			 ScoreHackathonFall2016
		</div>
	</div>

	</div>
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
                  "caption" => "401K ESTIMATED AMOUNT OVER YEARS",
				  "subCaption"=> "Yearly Amount",
                "xAxisName"=> "Year",
                "yAxisName"=> "Total Amount (In USD)",
                "numberPrefix"=> "$",
            "paletteColors" => "#0075c2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "0",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "10"
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

        	$columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	//// Close the database connection
        	//$dbhandle->close();
     	}

$pieChart1 = new FusionCharts("pie3d", "ex1" , "100%", 400, "chart-2", "json", '{
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

$strQuery = "SELECT * FROM hack order by year ";
 	$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
  if ($result) {
        	
	$arrData = array(
        "chart" => array(
        	  "caption" => "EMPLOYEE MATCH",
				  "subCaption"=> "Without vs With",
            "xAxisname"=> "Year",
            "yAxisName"=> "Amount",
         "captionFontSize"=> "14",
                "subcaptionFontSize"=> "14",
                "subcaptionFontBold"=> "0",
                "paletteColors"=> "#0075c2,#1aaf5d",
                "bgcolor"=> "#ffffff",
                "showBorder"=> "0",
                "showShadow"=> "0",
                "showCanvasBorder"=> "0",
                "usePlotGradientColor"=> "0",
                "legendBorderAlpha"=> "0",
                "legendShadow"=> "0",
                "showAxisLines"=> "0",
                "showAlternateHGridColor"=> "0",
                "divlineThickness"=> "1",
                "divLineIsDashed"=> "1",
                "divLineDashLen"=> "1",
                "divLineGapLen"=> "1",
                "xAxisName"=> "Year",
                "showValues"=> "0"   
          	)
         	);
        	// creating array for categories object
        	
        	$categoryArray=array();
        	$dataseries1=array();
        	$dataseries2=array();
        	
          // pushing category array values
        	while($row = mysqli_fetch_array($result)) {				
				    array_push($categoryArray, array(
					  "label" => $row["year"]
					)
				);
				array_push($dataseries1, array(
					"value" => $row["price"]
					) 
				);
			
				array_push($dataseries2, array(
					"value" => 1.5*$row["price"]
					)
				);
    
    	}
        	
    	$arrData["categories"]=array(array("category"=>$categoryArray));
			// creating dataset object
			$arrData["dataset"] = array(array("seriesName"=> "Week Load", "data"=>$dataseries1),array("seriesName"=> "Max Capacity", "renderAs"=> "line","showValues"=> "0", "data"=>$dataseries2));
		
			
				
      $jsonEncodedData = json_encode($arrData);
            			
			// chart object
      $msChart = new FusionCharts("msline", "line" , "100%", "400", "chart-container", "json", $jsonEncodedData);
      
      $msChart->render();
			 
      // closing db connection
      $dbhandle->close();
           
   }
		
  
	?>
		

<div style="width:800px; height:100%; margin-left:630px; margin-right:0"> <!-- Fusion Charts will render here-->
<div  id="chart-1" style="width:800px;height:50%;display:inline-block;float:right;position:relative;margin-top:20px" >  </div>
  <div  id="chart-2" style="width:800px;height:50%;display:inline-block;float:left;position:relative"  > </div>  
  <div id="chart-container"><!-- Fusion Charts will render here--></div>
  </div>


  </body>

</html>