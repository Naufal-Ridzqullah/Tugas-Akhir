<?php
header ('Content-type: text/event-stream');
header ('Cache-Control: no-cache');

include_once "../config/database.php";

$query = "SELECT * FROM data ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if($row = mysqli_fetch_assoc($result))
	{
		echo "data: " . json_encode($row) . "\n\n";
		flush();
	}