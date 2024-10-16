<?php

    include('../includes/connect.php');
    header("Content-Type: application/json");

    $get_device_type=retrieve("SELECT type, COUNT(*) as count_device_type FROM other_devices GROUP BY type",array());
    $data = [];

    foreach ($get_device_type as $row) {
        $data[] = [
            'type' => $row['type'],
            'count' => $row['count_device_type']
        ];
    }

    echo json_encode($data);

?>