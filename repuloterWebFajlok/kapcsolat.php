<?php

$ip = "localhost";
$username = "root";
$password = "";
$db = "repuloter_project";
$port = 3306;

$con = new mysqli($ip,$username,$password,$db,$port);

if ($con->connect_error) {
  echo '<span style="color:red;">Sikertelen csatlakozás!</span>';
} else
{
  //echo '<span style="color:green;">Sikeres csatlakozás!</span>';
}

?>