<?php include('includes/header.php'); ?>
<?php include('library/functions.php'); ?>
<?php include('includes/navbar.php'); ?>
<?php $page_title = "Betson Inventory"; ?>
<div class="row mx-auto">
    <div class="col-md-12 mb-2">
        <div class="row mt-5">
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-header p-3 blue darken-1 text-white">
                        Manage Devices
                    </div>
                    <a class="btn col-12 col-sm-12 col-md-3 col-lg-2 mr-auto ml-auto" style="background-color: #2d3436;" data-toggle="modal" data-target="#add_devices_modal">Add Devices</a>
                    <div class="container mt-1">
                        <div class="row justify-content-center">
                            <?php getDevicesType(); ?>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered table-sm text-center" width="100%" cellspacing="0" cellpadding="0" id="tblDevices">
                                    <thead>
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
                                                            <i class='fas fa-edit'></i>
                                                        </span>
                                                        <span class='mr-1 delete_device'
                                                            delete_device_id='".$getDevices[$i]['id']."'>
                                                            <i class='fa fa-trash'></i>
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

    $("#tblDevices").DataTable({
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