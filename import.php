<?php
sleep (3);
//database connection details
$connect = mysql_connect('localhost','root','');
if (!$connect) {
 die('Could not connect to MySQL: ' . mysql_error());
}
//your database name
$cid =mysql_select_db('total',$connect);
//truncate data
$query1 = "truncate hack";
$s1     = mysql_query($query1, $connect );
// SQL Query to insert data into DataBase
$query = "LOAD DATA INFILE '/Applications/XAMPP/xamppfiles/htdocs/sub/myFile.csv' INTO TABLE hack FIELDS TERMINATED BY ',' LINES TERMINATED BY '|'";
$s     = mysql_query($query, $connect );
ini_set('auto_detect_line_endings',FALSE);
mysql_close($connect);
?>