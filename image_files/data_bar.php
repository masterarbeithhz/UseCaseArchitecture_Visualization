<?php
header('Content-Type: application/json');
include('envVariables.php');
$conn = mysqli_connect(DATABASENAME,DATABASEUSER,DATABASEPSWD,DATABASEDB);

$sqlQuery = "SELECT id,received_at,dev_location_name,pax_counter FROM nodeRedResults ORDER BY id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
