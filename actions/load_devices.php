<?php

    include('../includes/connect.php');
    header("Content-Type: application/json");

    $get_devices=retrieve("SELECT * FROM devices",array());


    if ($get_devices !== false && count($get_devices) > 0) {
        $response = array('status' => 'success', 'data' => $get_devices);
    } else {
        $response = array('status' => 'error', 'message' => 'No devices found or error in query');
    }

    echo json_encode($response);

?>