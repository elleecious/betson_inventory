<?php
    include('../includes/connect.php');
    include('../library/functions.php');

    header('Content-Type: application/json');
    $response = array('status' => 'error', 'message' => 'Invalid request');

    $edit_other_device_id=$_POST['edit_other_device_id'];
    $edit_brand = $_POST['edit_brand'];
    $edit_model = $_POST['edit_model'];
    $edit_serial_number = $_POST['edit_serial_number'];
    $edit_type = $_POST['edit_type'];
    $edit_inventory_number = $_POST['edit_inventory_number'];

    $getOtherDevice = retrieve("SELECT * FROM other_devices WHERE id=?",array($edit_other_device_id));
    $device_name = $getOtherDevice[0];

    $save_other_devices_sql = manage("UPDATE other_devices SET brand = ?, model = ?, serial_number = ?, type = ?, inventory_number = ? WHERE id = ?",
                    array($edit_brand,$edit_model,$edit_serial_number,$edit_type,$edit_inventory_number,$edit_other_device_id));

    $logs_result = manage("INSERT INTO logs (computer_name,ip_address,page,action,details,date) 
                            VALUES (?,?,?,?,?,?)",
                    array(gethostbyaddr($_SERVER['REMOTE_ADDR']),getPublicIP(),"HOME","UPDATE",        
                        "<details>
                            <p>Update Device on Inventory</p>
                            <p>
                                Brand: ".$device_name['brand']." => <span class='font-weight-bold'>".$edit_brand."</span><br>
                                Model: ".$device_name['model']." => <span class='font-weight-bold'>".$edit_model."</span><br>
                                Serial Number: ".$device_name['serial_number']." => <span class='font-weight-bold'>".$edit_serial_number."</span><br>
                                Type: ".$device_name['type']." => <span class='font-weight-bold'>".$edit_type."</span><br>
                                Inventory Number: ".$device_name['inventory_number']." => <span class='font-weight-bold'>".$edit_inventory_number."</span><br>
                            </p>
                        </details>", date('Y-m-d H:i:s a')));

    if ($save_other_devices_sql && $logs_result) {
        $response = array('status' => 'success', 'message' => 'Device updated successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to update');
    }
    
    echo json_encode($response);
?>