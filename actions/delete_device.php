<?php

include('../includes/connect.php');
include('../library/functions.php');
header('Content-Type: application/json');
$response = array('status' => 'error', 'message' => 'Invalid request');

$delete_device_id=$_POST['delete_device_id'];

$delete_device_sql=manage("DELETE FROM devices WHERE id=?",array(htmlspecialchars($delete_device_id)));

$logs_result = manage("INSERT INTO logs (computer_name,ip_address,page,action,details,date) 
                        VALUES (?,?,?,?,?,?)",
                array(gethostbyaddr($_SERVER['REMOTE_ADDR']),getPublicIP(),"HOME","DELETE",         
                "<details>
                <p>Remove Device on Inventory</p>
                <p>ID: <span class='font-weight-bold'>".$delete_device_id."</span></p>
                </details>", date('Y-m-d H:i:s a')));

if ($delete_device_sql && $logs_result) {
    $response = array('status' => 'success', 'message' => 'Device deleted successfully');
} else {
    $response = array('status' => 'error', 'message' => 'Failed to delete device');
}

echo json_encode($response);
?>