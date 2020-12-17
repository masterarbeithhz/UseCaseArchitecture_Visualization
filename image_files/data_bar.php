<?php
header('Content-Type: application/json');

$conn = mysqli_connect("mysql-service","root","Philipp1","testdb");

$sqlQuery = "SELECT id,received_at,dev_location_name,pax_counter FROM nodeRedResults ORDER BY id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
