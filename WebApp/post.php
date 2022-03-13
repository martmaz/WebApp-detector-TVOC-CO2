<?php
//odebranie danych z arduino

$time = time();
$temp1 = $_POST["TVOC"];
$temp2 = $_POST["CO2"];
//$temp3 = $_POST["temperatura_F"];
$temp4 = $_POST["temperatura_C"];
$temp5 = $_POST["wilgotnosc"];
$file = 'temp.html';
$data1 = $time."  -  ".$temp1;

//$data = $time.":".$temp1 <br> $temp2.",".$temp3.",".$temp4.",".$temp5;

//przesłanie danych na serwer www
file_put_contents($file, $temp1);
?>