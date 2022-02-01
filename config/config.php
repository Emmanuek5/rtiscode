<?php

include('./config/functions.php');
include('./config/source.php');

$host = "localhost";
$user= "root";
$pass = "";
$db = "num";



$css = "./assets/w3.css/w3.css";
$css1 = "<link rel='stylesheet' href='https://unicons.iconscout.com/release/v4.0.0/css/line.css'>";
$name="Webwonder";
$con = mysqli_connect($host,$user,$pass,$db);

if ($con) {

    # code...
}else {
    
    echo "Connention error ". mysqli_connect_error();
}










