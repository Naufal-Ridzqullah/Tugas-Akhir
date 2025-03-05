<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "powermon1";

$conn = mysqli_connect($host,$user,$pass,$db);

if (!$conn)
{
    echo "Database Gagal Terhubung" ;
}