<?php
// function OpenCon()
//  {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db_name = "renthouse";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db_name) or die("Connect failed: %s\n". $conn-> error);
 

 ?>