<?php
    include('../includes/connect.php');

    header('Content-Type: application/json');

    $type = $_POST['type'];

    $getTypeQuery = retrieve("SELECT inventory_number FROM other_devices WHERE type=? ORDER BY id DESC LIMIT 1", array($type));

    if (!empty($getTypeQuery)) {

        $lastInventoryNumber = $getTypeQuery[0]['inventory_number'];
        $lastNumber = (int) substr($lastInventoryNumber, -4);
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $newNumber = "0001";
    }

    echo json_encode(['inventory_number' => $newNumber]);

?>