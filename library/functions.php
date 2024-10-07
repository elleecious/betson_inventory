<?php
    function getDevicesType(){
        // Query to count the number of non-null values in each device column
        $type_sql = retrieve("
            SELECT 
                COUNT(system_unit) AS system_unit_count, 
                COUNT(keyboard) AS keyboard_count, 
                COUNT(monitor) AS monitor_count, 
                COUNT(mouse) AS mouse_count, 
                COUNT(headset) AS headset_count
            FROM devices", array());
    
        // Defining colors for each device type
        $get_device_color = array(
            "System Unit" => "#2962FF",
            "Monitor" => "#6200EA",
            "Keyboard" => "#2ecc71",
            "Mouse" => "#c0392b",
            "Headset" => "#f1c40f"
        );
    
        // Matching the counts from the query to the corresponding device types
        $device_counts = [
            "System Unit" => $type_sql[0]['system_unit_count'],
            "Monitor" => $type_sql[0]['monitor_count'],
            "Keyboard" => $type_sql[0]['keyboard_count'],
            "Mouse" => $type_sql[0]['mouse_count'],
            "Headset" => $type_sql[0]['headset_count'],
        ];
    
        // Loop through each device type and display the count
        foreach ($get_device_color as $stat_key => $stat_value) {
            $count = isset($device_counts[$stat_key]) ? $device_counts[$stat_key] : 0;
            echo "
            <div class='col-5 col-sm-4 col-md-2 mb-4 mr-2' style='background-color:" . $stat_value . "'>
                <div class='p-3 text-white text-center'>
                    " . $stat_key . " <br><span>" . $count . "</span>
                </div>
            </div>";
        }
    }

    function getPublicIP() {
        $url = 'https://ipinfo.io/json';
        $response = @file_get_contents($url);
        $data = json_decode($response, true);
        return $data['ip'];
    }
?>
