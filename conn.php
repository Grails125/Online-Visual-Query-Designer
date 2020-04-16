<?php 

$username = "root";     // put your username here
$password = "123456";     // put your password here

//$dbc_info_sch= mysqli_connect("10.10.60.110:3306",$username,$password,"information_schema");
$dbc_info_sch= mysqli_connect("localhost:6666",$username,$password,"information_schema");
$dbc=$dbc_info_sch;
?>

