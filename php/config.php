<?php

$host = "localhost";
$user= "root";
$pass = "";
$db = "num";

$css = "http://localhost/w3.css/w3.css";
$name="Webwonder";
$con = mysqli_connect($host,$user,$pass,$db);
$conn = $con;

if ($con) {

    # code...
}else {
    
    echo "Connention error ". mysqli_connect_error();
}










