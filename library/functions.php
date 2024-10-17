<?php

    function getDevicesType(){

        $type_sql = retrieve("SELECT 
                                COUNT(CASE WHEN TRIM(system_unit) <> '' THEN 1 END) AS system_unit_count,
                                COUNT(CASE WHEN TRIM(keyboard) <> '' THEN 1 END) AS keyboard_count,
                                COUNT(CASE WHEN TRIM(monitor) <> '' THEN 1 END) AS monitor_count,
                                COUNT(CASE WHEN TRIM(mouse) <> '' THEN 1 END) AS mouse_count,
                                COUNT(CASE WHEN TRIM(headset) <> '' THEN 1 END) AS headset_count
                            FROM devices
            ", array());
    
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
            <div class='col-5 col-sm-4 col-md-2 mb-4 mr-2 hvr-pop' style='background-color:" . $stat_value . "'>
                <div class='p-3 text-white text-center'>
                    " . $stat_key . " <br><span>" . $count . "</span>
                </div>
            </div>";
        }
    }

    function getOherDevicesType(){
        $type_sql=retrieve("SELECT type,  COUNT(*) as count FROM other_devices GROUP BY type",array());
       
        $get_device_color = array(
            "Laptop" => "#2962FF",
            "Printer" => "#d31900",
            "Modem" => "#001848",
            "Router" => "#340a0b",
            "Switches" => "#6200EA",
            "UPS" => "#2ecc71",
            "AVR" => "#ff6600",
        );

        $device_counts = [];

        foreach ($type_sql as $row) {
            $device_counts[$row['type']] = $row['count'];
        }

        foreach ($get_device_color as $stat_key => $stat_value) {
            $count = isset($device_counts[$stat_key]) ? $device_counts[$stat_key] : 0;
            echo "
            <div class='col-5 col-sm-4 col-md-2 mb-4 mr-2 hvr-pop' style='background-color:" . $stat_value . "'>
                <div class='p-3 text-white text-center'>
                    " . $stat_key . " <br><span>" . $count . "</span>
                </div>
            </div>";
        }
    }

    function productionMap(){
        $device_sql = retrieve("SELECT * FROM devices ORDER BY cubicle_number ASC",array());
        foreach ($device_sql as $device_row) {
            echo "
            <div class='col-12 col-xl-2 col-lg-2 col-sm-3 col-md-2 mb-4 mr-2 ml-2 betson-color hvr-pop get_device_info' data-toggle='modal' data-target='#deviceInfoModal'
                data-system-unit='".$device_row['system_unit']."'
                data-monitor='".$device_row['monitor']."'
                data-keyboard='".$device_row['keyboard']."'
                data-mouse='".$device_row['mouse']."'
                data-headset='".$device_row['headset']."'
            >
                <div class='p-3 text-white text-center'>
                    <span class='fa fa-desktop fa-2x'></span><br>
                    ".($device_row['assigned_agent'] ? "<h6 class='mt-1'> ".$device_row['assigned_agent']."</h6>" : "Vacancy" )."
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
