<?php

$host = "localhost";
$username = "root";
$password = "c0nt3stp455";
$database = "contesthours_stage15";

date_default_timezone_set("Asia/Kolkata");

$start = date("Y-m-d H:i:s",strtotime("-5 mins"));
$end = date("Y-m-d H:i:s");

$conn = new mysqli($host,$username,$password,$database);


$sql = "Update contest set status = 'judging' where status = 'open' and close_date between '$start' and '$end'";

$conn->query($sql);
