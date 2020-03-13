<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$databasename = 'housingdb';

//To connect to a database use the php function called mysqli_connect()
//my sqli function returns a boolean datatype

$connection = mysqli_connect($hostname, $username ,$password,$databasename);

if($connection == false){
    echo "Connection not successful<br>";
    die("ERROR:".mysqli_connect_error());
}

?>
<p style="b"></p>
