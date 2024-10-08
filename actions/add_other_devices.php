<?php

    include('../includes/connect.php');
    include('../library/functions.php');

    header('Content-Type: application/json');
    $response = array('status' => 'error', 'message' => 'Invalid request');

    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $serial_number = $_POST['serial_number'];
    $type = $_POST['type'];
    $inventory_number = $_POST['inventory_number'];

    $add_other_devices_sql = manage("INSERT INTO other_devices (brand,model,serial_number,type,inventory_number,created_at)
                            VALUES(?,?,?,?,?,?)",
                            array($brand,$model,$serial_number,$type,$inventory_number,date("Y-m-d H:i:s a")));
    $logs_other_result = manage("INSERT INTO logs (computer_name,ip_address,page,action,details,date)
                                VALUES (?,?,?,?,?,?)",
                        array(gethostbyaddr($_SERVER['REMOTE_ADDR']),getPublicIP(),"HOME","ADD",         
                            "<details>
                                <p>Add Devices on Inventory</p>
                                <p>
                                    Brand: <span class='font-weight-bold'>".$brand."</span><br>
                                    Model: <span class='font-weight-bold'>".$model."</span><br>
                                    Serial Number: <span class='font-weight-bold'>".$serial_number."</span><br>
                                    Type: <span class='font-weight-bold'>".$type."</span><br>
                                    Inventory Number: <span class='font-weight-bold'>".$inventory_number."</span><br>
                                    Date Created: <span class='font-weight-bold'>".date('Y-m-d H:i:s a')."</span>
                                </p>
                            </details>", date('Y-m-d H:i:s a')));
    if ($add_other_devices_sql && $logs_other_result) {
        $response = array('status'=>'success','message'=>"Added Other Devices successfully");
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to add a other devices');
    }

    echo json_encode($response);

?>