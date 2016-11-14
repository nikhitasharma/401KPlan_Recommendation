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
  	<title>Capacity and Due Database</title>
    <link  rel="stylesheet" type="text/css" href="css/style.css" />

  	<!-- You need to include the following JS file to render the chart.
  	When you make your own charts, make sure that the path to this JS file is correct.
  	Else, you will get JavaScript errors. -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>NIC Product Database</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link href="css/multiColumnTemplate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css">

  <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
  </head>

   <body>
	
<div class="container" style="" >
<header>
    <div class="">
     <h1 class="title" style="background:#2064b1;"> <a href="index.php"  style="text-decoration:none;"> <img src="images/logo2.png" align="middle"> </a>  <font color="white">CAPACITY CHART</font></h1>
    </div>
    <nav style="background:#CDCDCD;">
      <ul>
	   <h3>
	<center>
        <a href="testdb.php"  style="text-decoration:underline;"><font color="#545454"> CHART </font></a> &nbsp&nbsp&nbsp
   <a href="import.php"  style="text-decoration:none;"><font color="#545454"> IMPORT</font></a>&nbsp&nbsp&nbsp
    <a href="viewc_due.php"  style="text-decoration:none;"><font color="#545454"> VIEW </font></a>&nbsp&nbsp&nbsp
	   </center>
    <!--<li ><a href="delete.php"  style="text-decoration:none;"><font color="white"> DELETE </font></a></li>
   
      
	   <li contextmenu="insert.php">CONTACT</li>-->
     </h3>
	  </ul>
	  
    </nav>
  </header>
<center>
<h2 ><font color="#095A64"> ENTER DATE RANGE TO SEARCH</h2></font>
<form align="middle" method="POST" action="" style="width:500px "  role="search">
        <div class="form-group">
          FROM&nbsp&nbsp<input name="date1" type="date" required="required" id="date1">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		  TO&nbsp&nbsp<input name="date2" type="date" required="required" id="date2">
        </div>
        
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
<hr>
</center>
  	<?php
	
if(isset($_POST['date1']))
{
	if(isset($_POST['date2']))

{
$value1=$_POST['date1'];
//$value9=date_format($value1,"mm-dd-yyyy");
//echo "$value9";

$value2=$_POST['date2'];
echo "<center>";     
     	$strQuery = "SELECT DATE(date) AS date, SUM(quantity) AS quantity FROM due where date>='$value1' and date<='$value2' GROUP BY date ORDER BY `date`";
		$strQuery2 = "SELECT week(date) AS week, SUM(quantity) AS quantity FROM due where date>='$value1' and date<='$value2' GROUP BY yearweek(date) ";

     	// Execute the query, or else return the error message.
     	//$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");
        $result2 = $dbhandle->query($strQuery2) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData = array(
        	    "chart" => array(
                  "caption"=> "Sales Per Employee for 2014",
        "palette"=> "2",
        "animation"=> "1",
        "formatnumberscale"=> "1",
        "decimals"=> "0",
        "numberprefix"=> "$",
        "pieslicedepth"=> "30",
        "startingangle"=> "125",
		  "showLabels"=> "0",
                "enableSmartLabels"=> "0",
                "enableMultiSlicing"=> "0",
                "showLegend"=> "1",
        "showborder"=> "0"
              	)
           	);
		

        	$arrData["data"] = array();

	// Push the data into the array
        	while($row = mysqli_fetch_array($result)) {
           	array_push($arrData["data"], array(
              	"label" => $row["date"],
              	"value" => $row["quantity"]
              	)
           	);
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData = json_encode($arrData);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart = new FusionCharts("pie3d", "myFirstChart" , 500, 500, "chart-1", "json", $jsonEncodedData);

        	// Render the chart
        	$columnChart->render();

        	//// Close the database connection
        	//$dbhandle->close();
     	}
		
		if ($result2) {
        	// The `$arrData` array holds the chart attributes and data
        	$arrData2 = array(
        	    "chart" => array(
                  "caption"=> "Sales Per Employee for 2014",
        "palette"=> "2",
        "animation"=> "1",
        "formatnumberscale"=> "1",
        "decimals"=> "0",
        "numberprefix"=> "$",
        "pieslicedepth"=> "30",
        "startingangle"=> "125",
        "showborder"=> "0",
		  "showLabels"=> "0",
                "enableSmartLabels"=> "0",
                "enableMultiSlicing"=> "0",
                "showLegend"=> "1",

				)
           	);
			

        	$arrData2["data"] = array();
			
	// Push the data into the array
        	while($row2 = mysqli_fetch_array($result2)) {
           	array_push($arrData2["data"], array(
              	"label" => $row2["week"],
              	"value" => $row2["quantity"]
              	)
           	);
			
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData2 = json_encode($arrData2);

	/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

        	$columnChart2 = new FusionCharts("pie3d", "myFirstChart2" , 1000, 300, "chart-1", "json", $jsonEncodedData2);

        	// Render the chart
        	$columnChart2->render();

        	// Close the database connection
        	$dbhandle->close();
     	}
		
			
	}

$query4 = "SELECT week('$value1') as week,year('$value1') as year" ;
$result4=mysql_query($query4) or die("Query Failed : ".mysql_error());
$row4=mysql_fetch_array($result4);
$query4_1 = "SELECT concat(year('$value1'),week('$value1')) as concat" ;
$result4_1=mysql_query($query4_1) or die("Query Failed : ".mysql_error());
$row4_1=mysql_fetch_array($result4_1);
echo "<center>";
//echo"<h4>Total Quantity for Selected dates is: ";
//echo $row4_1['concat'] ;
$last1=$row4_1['concat'];
//echo "last is $last1";
//echo "<br>";

$query5 = "SELECT week('$value2') as week,year('$value2') as year" ;
$result5=mysql_query($query5) or die("Query Failed : ".mysql_error());
$row5=mysql_fetch_array($result5);
$query5_1 = "SELECT concat(year('$value2'),week('$value2')) as concat" ;
$result5_1=mysql_query($query5_1) or die("Query Failed : ".mysql_error());
$row5_1=mysql_fetch_array($result5_1);
//echo $row5_1['concat'];
$last2=$row5_1['concat'];


if($row4['year']==$row5['year'])
{
for($i=$last1;$i<=$last2;$i++)
{
 $sub_i = substr($i, -2);
	$query6 = "SELECT str_to_date('$i monday' , '%X%V %W') as date" ;
$result6=mysql_query($query6) or die("Query Failed : ".mysql_error());
$row6=mysql_fetch_array($result6);
	echo"<b><---</b>";
	echo "Week $sub_i starts on:";
	echo "<b><font color='green'>";
	echo $row6['date'];
	echo "</font></b>";
	echo"--->";
}
}
else 
{
 echo "select same year";
}
}

else
echo "<h2><center>SELECT DATES TO DISPLAY THE CHARTS</center></h2>";

  	?>

  	<div id="chart-1"><!-- Fusion Charts will render here--></div>

   </body>

</html>