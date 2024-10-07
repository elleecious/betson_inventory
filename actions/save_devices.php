<?php
    include('../includes/connect.php');
    include('../library/functions.php');

    header('Content-Type: application/json');
    $response = array('status' => 'error', 'message' => 'Invalid request');

    $edit_device_id=$_POST['edit_device_id'];
    $edit_cubicle_number = $_POST['edit_cubicle_number'];
    $edit_assigned_agent = $_POST['edit_assigned_agent'];
    $edit_system_unit=$_POST['edit_system_unit'];
    $edit_monitor=$_POST['edit_monitor'];
    $edit_keyboard=$_POST['edit_keyboard'];
    $edit_mouse=$_POST['edit_mouse'];
    $edit_headset=$_POST['edit_headset'];
    

    $getDevice = retrieve("SELECT * FROM devices WHERE id=?",array($edit_device_id));
    $device_name = $getDevice[0];

    $save_devices_sql = manage("UPDATE devices SET cubicle_number=?, assigned_agent=?, system_unit=?, 
        monitor=?, keyboard=?, mouse=?, headset=?, updated_at=? WHERE id=?",
        array($edit_cubicle_number,$edit_assigned_agent,$edit_system_unit,$edit_monitor,$edit_keyboard,$edit_mouse,$edit_headset,date("Y-m-d H:i:s a"),$edit_device_id));

    $logs_result = manage("INSERT INTO logs (computer_name,ip_address,page,action,details,date) 
                            VALUES (?,?,?,?,?,?)",
                    array(gethostbyaddr($_SERVER['REMOTE_ADDR']),getPublicIP(),"HOME","UPDATE",        
                        "<details>
                            <p>Update Device on Inventory</p>
                            <p>
                                Cubicle Name: ".$device_name['cubicle_number']." => <span class='font-weight-bold'>".$edit_cubicle_number."</span><br>
                                Assigned Agent: ".$device_name['assigned_agent']." => <span class='font-weight-bold'>".$edit_assigned_agent."</span><br>
                                System Unit: ".$device_name['system_unit']." => <span class='font-weight-bold'>".$edit_system_unit."</span><br>
                                Monitor: ".$device_name['monitor']." => <span class='font-weight-bold'>".$edit_monitor."</span><br>
                                Keyboard: ".$device_name['keyboard']." => <span class='font-weight-bold'>".$edit_keyboard."</span><br>
                                Mouse: ".$device_name['mouse']." => <span class='font-weight-bold'>".$edit_mouse."</span><br>
                                Headset: ".$device_name['headset']." => <span class='font-weight-bold'>".$edit_headset."</span><br>
                            </p>
                        </details>", date('Y-m-d H:i:s a')));

    if ($save_devices_sql && $logs_result) {
        $response = array('status' => 'success', 'message' => 'Device updated successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to update');
    }
    
    echo json_encode($response);
?>