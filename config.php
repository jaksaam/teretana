<?php

session_start();   //startovanje sesije

$servername = "localhost";  //OVO JE SAMO ZA KONEKCIJU ZA BAZU, OVO NEMA VEZE DOLE SA ADMINISTRATOROM.
$db_username = "root";
$db_password = "";
$database_name = "teretana";

$conn = mysqli_connect($servername, $db_username, $db_password, $database_name);  //komanda i nacin kako se povezati sa bazom.

if(!$conn) {
    die("Neuspesna konekcija sa bazom.");
}
