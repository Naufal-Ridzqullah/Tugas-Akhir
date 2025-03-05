<?php
include_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$voltage = $_POST['voltage'];
$current = $_POST['current'];
$power = $_POST['power'];
$energy = $_POST['energy'];
$frequency = $_POST['frequency'];
$powerfactor = $_POST['powerfactor'];

$query = "INSERT INTO data (Voltage, Current, Power, Energy, Frequency, PowerFactor) VALUES ($voltage, $current, $power, $energy, $frequency, $powerfactor)";
$result = mysqli_query($conn, $query);


if($result) {
    echo "Tersimpan pada Database";
}
}else{
    echo "Gagal Tersimpan ke Database";
}