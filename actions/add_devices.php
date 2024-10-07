<?php
    include('../includes/connect.php');
    include('../library/functions.php');

    header('Content-Type: application/json');
    $response = array('status' => 'error', 'message' => 'Invalid request');

    $assigned_agent = $_POST['assigned_agent'];
    $cubicle_number = $_POST['cubicle_number'];
    $system_unit = $_POST['system_unit'];
    $monitor = $_POST['monitor'];
    $keyboard = $_POST['keyboard'];
    $mouse = $_POST['mouse'];
    $headset = $_POST['headset'];


    $add_devices_sql = manage("INSERT INTO devices (cubicle_number,assigned_agent,system_unit,monitor,keyboard,mouse,headset,created_at) 
                            VALUES(?,?,?,?,?,?,?,?)",
                        array($cubicle_number,$assigned_agent,$system_unit,$monitor,$keyboard,$mouse,$headset,date('Y-m-d H:i:s a')));

    $logs_result = manage("INSERT INTO logs (computer_name,ip_address,page,action,details,date)
                        VALUES (?,?,?,?,?,?)",
                    array(gethostbyaddr($_SERVER['REMOTE_ADDR']),getPublicIP(),"HOME","ADD",         
                        "<details>
                            <p>Add Devices on Inventory</p>
                            <p>
                                Cubicle Number: <span class='font-weight-bold'>".$cubicle_number."</span><br>
                                Employee Name: <span class='font-weight-bold'>".$assigned_agent."</span><br>
                                System Unit: <span class='font-weight-bold'>".$system_unit."</span><br>
                                Monitor: <span class='font-weight-bold'>".$monitor."</span><br>
                                Keyboard: <span class='font-weight-bold'>".$keyboard."</span><br>
                                Mouse: <span class='font-weight-bold'>".$mouse."</span><br>
                                Headset: <span class='font-weight-bold'>".$headset."</span><br>
                                Date Created: <span class='font-weight-bold'>".date('Y-m-d H:i:s a')."</span>
                            </p>
                        </details>", date('Y-m-d H:i:s a')));

    if ($add_devices_sql && $logs_result) {
        $response = array('status'=>'success','message'=>"Added device successfully");
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to add a devices');
    }

    echo json_encode($response);

?>