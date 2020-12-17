<?php
header('Content-Type: application/json');

$conn = mysqli_connect("mysql-service","root","Philipp1","testdb");

$sqlQuery_readings = "SELECT dev_id,received_at,count_wifi,count_ble FROM readings ORDER BY dev_id";
$sqlQuery_devices = "SELECT dev_id,dev_location_name,dev_latitude,dev_longitude FROM devices ORDER BY dev_id";

$result_readings = mysqli_query($conn,$sqlQuery_readings);
$result_devices = mysqli_query($conn,$sqlQuery_devices);

$data_sensors = array();
foreach ($result_devices as $row) {
	$data_sensors[] = $row;
}
$data_readings = array();
foreach ($result_readings as $row) {
	$data_readings[] = $row;
}
$data = array($data_sensors,$data_readings);
mysqli_close($conn);

echo json_encode($data);
?>
