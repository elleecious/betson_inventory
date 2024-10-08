<?php
    function getDevicesType(){

        $type_sql = retrieve("
            SELECT 
                COUNT(system_unit) AS system_unit_count, 
                COUNT(keyboard) AS keyboard_count, 
                COUNT(monitor) AS monitor_count, 
                COUNT(mouse) AS mouse_count, 
                COUNT(headset) AS headset_count
            FROM devices", array());
    
        $get_device_color = array(
            "System Unit" => "#2962FF",
            "Monitor" => "#6200EA",
            "Keyboard" => "#2ecc71",
            "Mouse" => "#c0392b",
            "Headset" => "#f1c40f"
        );
    
        $device_counts = [
            "System Unit" => $type_sql[0]['system_unit_count'],
            "Monitor" => $type_sql[0]['monitor_count'],
            "Keyboard" => $type_sql[0]['keyboard_count'],
            "Mouse" => $type_sql[0]['mouse_count'],
            "Headset" => $type_sql[0]['headset_count'],
        ];
    
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

    function getOherDevicesType(){
        $type_sql=retrieve("SELECT type,  COUNT(*) as count FROM other_devices GROUP BY type",array());
       
        $get_device_color = array(
            "System Unit" => "#2962FF",
            "Monitor" => "#6200EA",
            "Keyboard" => "#01392f",
            "Mouse" => "#c0392b",
            "Headset" => "#f1c40f",
            "Laptop" => "#eb9c4d",
            "Printer" => "#001848",
            "Modem" => "#17f9ff",
            "Router" => "#340a0b",
            "Switches" => "#615145",
            "UPS" => "#2ecc71",
            "AVR" => "#d6a692",
        );

        $device_counts = [];

        foreach ($type_sql as $row) {
            $device_counts[$row['type']] = $row['count'];
        }

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
