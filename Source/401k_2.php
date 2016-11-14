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
body{
  
  background-color: #FF6600;

}



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
 <script type="text/javascript">
        function codeAddress() {
            var age_var = <?php echo $_GET['YourAge'] ?>;
             document.getElementById("YourAge").value=age_var;

        }
        window.onload = codeAddress;
         </script>

<script>
function myFunction() {
    alert("I am an alert box!");
}
</script>
<script language="javascript" type="text/javascript" src="datetimepicker.js">
</script>
    <script>
    function load()
    {
        var age = document.getElementById("YourAge").value;
        document.getElementById("YourAge").innerHTML=age;
    }
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

 <body onload="codeAddress();">
 <center>	<h1><a>401 K Investment Plan Analytics</a></h1> </center>
	<div>
	<div style="width:50%; float:left">
	<div id="form_container" >

		<form id="form_3749" class="appnitro"  method="post" action="401k.php">
					<div class="form_description">
			<h2 style="font-size:180%">  401 K Plan Recommendation Form </h2>
			<p>Please provide below information in order for us to serve you</p>
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
		<div>
        <?php
        $Age=$_POST['element_5'];
        ?>
			<input  id="YourAge" value="<?php echo $Age ?>" required="required" onchange="validate();recommend_goal();calculate()" name="element_5" height="20px" class="element text medium" type="text" maxlength="255" /> 
		<span class="asterisk_input">  </span> 
    </div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Retirement Age </label>
		<div>
        <?php
        $Retage=$_POST['retage'];
        ?>
			<input value="<?php echo $Retage ?>"  onchange="recommend_goal();calculate()" required="required" id="RetirementAge" required="required" name="element_4" class="element text medium" type="text" maxlength="255" /> 
		<span class="asterisk_input">  </span> 
    </div> 

		</li>		<li id="li_8" >
		<label class="description" for="element_8">Salary </label>
		<span class="symbol">$</span> 
		<span>
         <?php
        $salary=$_POST['sal'];
        ?>
			<input id="Income" onchange="calculate()" value="<?php echo $salary ?>" required="required" class="element text currency" size="10"  type="text" />   .		
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
        <?php
        $hike=$_POST['hike'];
        ?>
			<input id="element_9_1" id="Increase" onchange="calculate()" required="required" name="element_9_1" class="element text currency" size="10" value="<?php echo $hike ?>" type="text" /> .		
			<label for="element_9_1">Percent</label>
		</span>
		
		 
		</li>		<li id="li_7" >
     <label class="description" for="element_4">Salary Percentage to 401K Plan </label>
		<div>
        <?php
        $salpercent=$_POST['salpercent'];
        ?>
			<input id="Contribution" onchange="calculate()" required="required"  name="element_4" class="element text medium" type="text" maxlength="255" value="<?php echo $salpercent ?>"/> 
		<span class="asterisk_input">  </span> </div> 
		<label class="description" for="element_7">Current 401k Balance </label>
		<div>
        <?php
        $currbal=$_POST['currbal'];
        ?>
			<input onchange="calculate()" id="Balance" value="<?php echo $currbal ?>"  required="required" name="element_7" class="element text medium" type="text" maxlength="255" /> 
		<span class="asterisk_input">  </span>
    </div> 
		
    
        <label class="description" for="element_4">Expected Annual Return Percent </label>
		<div>
        <?php
        $return=$_POST['return'];
        ?>
			<input id="Return" value="<?php echo $return ?>" onchange="calculate()" required="required"  name="element_4" class="element text medium" type="text" maxlength="255" /> 
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
        <?php
        $goal=$_POST['goal'];
        ?>
		<select class="element select medium" id="goal"  value="<?php echo $goal ?>" onchange="recommend_risk();calculate()" required="required" name="element_10"> 
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
        <?php
        $risk=$_POST['risk'];
        ?>
			<input id="risk" name="risk" value="<?php echo $risk ?>" class="element text medium" type="text" maxlength="255" required="required" onchange='document.getElementById("risk").value =  document.getElementById("risk_percent").value;'/> 
		</div> 
    
<div style="width:250px;height=1px;float:left" id="grad1" style="text-align:center;margin:auto;color:#888888;font-size:5px;font-weight:bold">
<?php
        $riskpercent=$_POST['riskpercent'];
        ?>
<input style="width:250px" type="range" min="1" max="100" step="1" value="<?php echo $riskpercent ?>"   id="risk_percent" name="passengers" onchange='document.getElementById("risk").value =  document.getElementById("risk_percent").value;' />

</div>
<span id="msg2" style="color:purple"></span>

		</li>
    
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="3749" />
			    
				<input style="height:50px;background-color:teal;float:right" id="saveForm" class="button_text" type="submit" name="submit" value="GO BACK TO YOUR HOME PAGE" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			 ScoreHackathonFall2016
		</div>
	</div>

	</div>
 <?php     
$columnChart = new FusionCharts("column2d", "ex1" , "100%", 400, "chart-1", "json", '{
      "chart": {
        "caption": "Networks International Corporation",
        "subCaption": "Weekly Load Capacity",
         "renderAt":"chart-1",
        "numberPrefix": "",
        "rotatevalues": "0",
        "plotToolText": "<div><b>$label</b><br/>Quantity : <b>$value</b></div>",
        "theme": "fint"
      },
      
      "data": [
	  {
        "label": "WEEK1",
        "value": "1025"
      }, 
      {
        "label": "WEEK2",
        "value": "1100"
      },
       {
        "label": "WEEK3",
        "value": "825"
      },
       {
        "label": "WEEK4",
        "value": "950"
      },
       {
        "label": "WEEK5",
        "value": "900"
      }
      ]
    }');
// Render the chart

$columnChart->render();

$pieChart1 = new FusionCharts("pie2d", "ex1" , "100%", 400, "chart-2", "json", '{
     "chart": {
       "caption": "Investment Plan",
 "renderAt":"chart-2",
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
?>


<div style="width:800px; height:100%; margin-left:800; margin-right:0; background-color: #ccffcc"  ><!-- Fusion Charts will render here-->
<div  id="chart-1" style="width:800px;height:50%;display:inline-block;float:right;background-color:yellow;position:relative" >  </div>
  <div  id="chart-2" style="width:800px;height:50%;display:inline-block;float:left;position:relative"  > </div>  
  
  </div>

  


  </body>

</html>