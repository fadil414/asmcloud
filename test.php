<?php
$host = "localhost";
$dbname = "atm-toys";
$user = "root";
$password = "";
$port = "5432";

$dsn = "pgsql:host=$host;dbname=$dbname;user=$user;port=$port;password=$password";

$db = new PDO($dsn);

if($db){
  echo "Connected <br />".$db;
}else {
  echo "Not connected";
}
 ?>