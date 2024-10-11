<?php include('includes/header.php'); ?>
<?php include('library/functions.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php $page_title = "Betson Inventory"; ?>
<div class="row mx-auto">
    <div class="col-md-12 mb-2">
        <div class="row mt-5">
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-header p-3 blue darken-1 text-white">
                        Add Devices
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" id="frmAddDevices">
                                    <div class="row">
                                        <?php
                                            $device_form = array(
                                                "cubicle_number" => "Cubicle Number",
                                                "assigned_agent" => "Assigned Agent",
                                                "system_unit" => "System Unit",
                                                "monitor" => "Monitor",
                                                "keyboard" => "Keyboard",
                                                "mouse" => "Mouse",
                                                "headset" => "Headset"
                                            );

                                            foreach ($device_form as $dfkey => $dfvalue) {
                                                echo "
                                                <div class='col-md-12'>
                                                    <small>".$dfvalue."</small>
                                                    <input class='form-control form-control-sm' type='text' name='".$dfkey."' id='".$dfkey."'>
                                                </div>";
                                            }
                                        ?>
                                    </div>
                                    <button type="submit" class="btn blue accent-4 white-text hvr-sweep-to-right" name="add_devices" id="add_devices">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 mb-2">
                <div class="card">
                    <div class="card-header p-3 blue darken-1 text-white">
                        Manage Devices
                    </div>
                    <div class="container mt-2">
                        <div class="row justify-content-center">
                            <?php getDevicesType(); ?>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-sm text-center" width="100%" cellspacing="0" cellpadding="0" id="tblDevices">
                                    <thead class="thead">
                                        <tr>
                                            <?php
                                                $stud_head=explode(",","Cubicle Number,Assigned Agent,System Unit,Monitor,Keyboard,Mouse,Headset,Actions");
                                                foreach($stud_head as $stud_val)
                                                {
                                                    echo "<th>".$stud_val."</th>";
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $getDevices=retrieve("SELECT * FROM devices",array());
                                        for ($i=0; $i < COUNT($getDevices); $i++) { 
                                            echo "<tr>
                                                    <td>".$getDevices[$i]['cubicle_number']."</td>
                                                    <td>".$getDevices[$i]['assigned_agent']."</td>
                                                    <td>".$getDevices[$i]['system_unit']."</td>
                                                    <td>".$getDevices[$i]['monitor']."</td>
                                                    <td>".$getDevices[$i]['keyboard']."</td>
                                                    <td>".$getDevices[$i]['mouse']."</td>
                                                    <td>".$getDevices[$i]['headset']."</td>
                                                    <td>
                                                            <span class='mr-1 edit_device'
                                                            edit_device_id='".$getDevices[$i]['id']."'
                                                            edit_cubicle_number='".$getDevices[$i]['cubicle_number']."'
                                                            edit_assigned_agent='".$getDevices[$i]['assigned_agent']."'
                                                            edit_system_unit='".$getDevices[$i]['system_unit']."'
                                                            edit_monitor='".$getDevices[$i]['monitor']."'
                                                            edit_keyboard='".$getDevices[$i]['keyboard']."'
                                                            edit_mouse='".$getDevices[$i]['mouse']."'
                                                            edit_headset='".$getDevices[$i]['headset']."'
                                                            data-toggle='modal' data-target='#edit_devices_modal'>
                                                            <i class='fas fa-edit hvr-pop'></i>
                                                        </span>
                                                        <span class='mr-1 delete_device'
                                                            delete_device_id='".$getDevices[$i]['id']."'>
                                                            <i class='fa fa-trash hvr-pop'></i>
                                                        </span>
                                                    </td>
                                                </tr>";
                                            }
                                        ?>
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-2">
                <div class="card">
                    <div class="card-header p-3 blue darken-1 text-white">
                       Add Other Devices 
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" id="frmAddOtherDevice">
                                    <div class="row">
                                        <?php
                                            $device_form = array(
                                                "brand" => "Brand",
                                                "model" => "Model",
                                                "serial_number" => "Serial Number",
                                            );

                                            foreach ($device_form as $dfkey => $dfvalue) {
                                                echo "
                                                <div class='col-md-12'>
                                                    <small>".$dfvalue."</small>
                                                    <input class='form-control form-control-sm' type='text' name='".$dfkey."' id='".$dfkey."'>
                                                </div>";
                                            }
                                        ?>
                                        <div class="col-md-12">
                                            <select class="mdb-select md-form" name="type" id="type">
                                                <option value="" disabled selected>Type</option>
                                                <?php
                                                $device_type=array("Laptop","Printer","Modem","Router","Switch","UPS","AVR","Aircon");
                                                sort($device_type);
                                                foreach ($device_type as $type) {
                                                    echo "<option value='".$type."'>".$type."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <small>Inventory Number</small>
                                            <input class="form-control form-control-sm" type="text" name="inventory_number" id="inventory_number">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn blue accent-4 white-text hvr-sweep-to-right" name="add_other_devices" id="add_other_devices">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 mb-2">
                <div class="card">
                    <div class="card-header p-3 blue darken-1 text-white">
                        Manage Other Devices
                    </div>
                    <div class="container mt-2">
                        <div class="row justify-content-center">
                            <?php getOherDevicesType(); ?>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-sm text-center" width="100%" cellspacing="0" cellpadding="0" id="tblOtherDevices">
                                    <thead class="thead">
                                        <tr>
                                            <?php
                                                $stud_head=explode(",","Brand,Model,Serial Number,Type,Inventory Number,Actions");
                                                foreach($stud_head as $stud_val)
                                                {
                                                    echo "<th>".$stud_val."</th>";
                                                }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $getOtherDevices=retrieve("SELECT * FROM other_devices",array());
                                        for ($i=0; $i < COUNT($getOtherDevices); $i++) { 
                                            echo "<tr>
                                                    <td>".$getOtherDevices[$i]['brand']."</td>
                                                    <td>".$getOtherDevices[$i]['model']."</td>
                                                    <td>".$getOtherDevices[$i]['serial_number']."</td>
                                                    <td>".$getOtherDevices[$i]['type']."</td>
                                                    <td>".strtoupper($getOtherDevices[$i]['type'])."-".$getOtherDevices[$i]['inventory_number']."</td>
                                                    <td>
                                                            <span class='mr-1 edit_other_device'
                                                            edit_other_device_id='".$getOtherDevices[$i]['id']."'
                                                            edit_brand='".$getOtherDevices[$i]['brand']."'
                                                            edit_model='".$getOtherDevices[$i]['model']."'
                                                            edit_serial_number='".$getOtherDevices[$i]['serial_number']."'
                                                            edit_type='".$getOtherDevices[$i]['type']."'
                                                            edit_inventory_number='".$getOtherDevices[$i]['inventory_number']."'
                                                            data-toggle='modal' data-target='#edit_other_devices_modal'>
                                                            <i class='fas fa-edit hvr-pop'></i>
                                                        </span>
                                                        <span class='mr-1 delete_other_device'
                                                            delete_other_device_id='".$getOtherDevices[$i]['id']."'
                                                            device_type='".$getOtherDevices[$i]['type']."'>
                                                            <i class='fa fa-trash hvr-pop'></i>
                                                        </span>
                                                    </td>
                                                </tr>";
                                            }
                                        ?>
                                    </tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/modal.php");?>
<?php include('includes/footer.php');?>
<script>
$(document).ready(function () {

    $(".edit_device").click(function(){
        $("#edit_device_id").val($(this).attr("edit_device_id"));
        $("#edit_cubicle_number").val($(this).attr("edit_cubicle_number"));
        $("#edit_assigned_agent").val($(this).attr("edit_assigned_agent"));
        $("#edit_system_unit").val($(this).attr("edit_system_unit"));
        $("#edit_monitor").val($(this).attr("edit_monitor"));
        $("#edit_keyboard").val($(this).attr("edit_keyboard"));
        $("#edit_mouse").val($(this).attr("edit_mouse"));
        $("#edit_headset").val($(this).attr("edit_headset"));
        $("#edit_devices_modal").modal("show");
    });

    

    $(".edit_other_device").click(function(){
        $("#edit_other_device_id").val($(this).attr("edit_other_device_id"));
        $("#edit_brand").val($(this).attr("edit_brand"));
        $("#edit_model").val($(this).attr("edit_model"));
        $("#edit_serial_number").val($(this).attr("edit_serial_number"));
        $("#edit_type").val($(this).attr("edit_type"));
        $("#edit_inventory_number").val($(this).attr("edit_inventory_number"));
        $("#edit_other_devices_modal").modal("show");
    });

    $("#tblDevices").DataTable({
		"scrollX": true,
		"info": true,
		"lengthChange": true,
		"paging": true,
		"searching": true,
        "pageLength":20,
		"order": [],
	});

    $("#tblOtherDevices").DataTable({
		"scrollX": true,
		"info": true,
		"lengthChange": true,
		"paging": true,
		"searching": true,
        "pageLength":20,
		"order": [],
	});
});
</script>