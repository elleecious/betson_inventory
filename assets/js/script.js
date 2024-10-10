$(document).ready(function() {
    
    $('.mdb-select').materialSelect();

    // tooltip initialization
    $('[data-toggle="tooltip"]').tooltip();
    
    $("#add_devices").click(function(e){
        e.preventDefault();

        $.ajax({
            url: "./actions/add_devices.php",
            type: "POST",
            dataType:'JSON',
            data: { 
                assigned_agent: $("#assigned_agent").val(),
                cubicle_number: $("#cubicle_number").val(),
                system_unit: $("#system_unit").val(),
                monitor: $("#monitor").val(),
                keyboard: $("#keyboard").val(),
                mouse: $("#mouse").val(),
                headset: $("#headset").val(),
                action:"add_devices"
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: response.status === 'success' ? 'Success!' : 'Error!',
                    text: response.message,
                    icon: response.status,
                });
                $("#frmAddDevices")[0].reset();
                setTimeout(function(){
                    location.reload();
                }, 1000);
            },
            error: function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $("#add_other_devices").click(function(e){
        e.preventDefault();

        $.ajax({
            url: "./actions/add_other_devices.php",
            type: "POST",
            dataType:'JSON',
            data: { 
                brand: $("#brand").val(),
                model: $("#model").val(),
                serial_number: $("#serial_number").val(),
                type: $("#type").val(),
                inventory_number: $("#inventory_number").val(),
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    title: response.status === 'success' ? 'Success!' : 'Error!',
                    text: response.message,
                    icon: response.status,
                });
                $("#frmAddDevices")[0].reset();
                setTimeout(function(){
                    location.reload();
                }, 1000);
            },
            error: function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $("#save_devices").click(function(e){
        e.preventDefault();

        $.ajax({
            url: "./actions/save_devices.php",
            type: "POST",
            dataType:'JSON',
            data: { 
                edit_device_id: $("#edit_device_id").val(),
                edit_cubicle_number:$("#edit_cubicle_number").val(),
                edit_assigned_agent: $("#edit_assigned_agent").val(),
                edit_system_unit: $("#edit_system_unit").val(),
                edit_monitor: $("#edit_monitor").val(),
                edit_keyboard: $("#edit_keyboard").val(),
                edit_mouse: $("#edit_mouse").val(),
                edit_headset: $("#edit_headset").val(),
            },
            success: function(response) { 
                console.log(response);
                Swal.fire({
                    title: response.status === 'success' ? 'Success!' : 'Error!',
                    text: response.message,
                    icon: response.status,
                });
                $("#edit_devices_modal").modal('hide');
                setTimeout(function(){
                    location.reload();
                }, 1000);
            },
            error: function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $("#save_other_devices").click(function(e){
        e.preventDefault();

        $.ajax({
            url: "./actions/save_other_devices.php",
            type: "POST",
            dataType:'JSON',
            data: { 
                edit_other_device_id: $("#edit_other_device_id").val(),
                edit_brand: $("#edit_brand").val(),
                edit_model: $("#edit_model").val(),
                edit_serial_number: $("#edit_serial_number").val(),
                edit_type: $("#edit_type").val(),
                edit_inventory_number: $("#edit_inventory_number").val(),
            },
            success: function(response) { 
                console.log(response);
                Swal.fire({
                    title: response.status === 'success' ? 'Success!' : 'Error!',
                    text: response.message,
                    icon: response.status,
                });
                $("#edit_other_devices_modal").modal('hide');
                setTimeout(function(){
                    location.reload();
                }, 1000);
            },
            error: function(error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $(".delete_device").click(function(e){
        e.preventDefault();
    
        var delete_device_id = $(this).attr('delete_device_id');
    
        Swal.fire({
            title: 'Delete Device?',
            text: 'Are you sure you want to delete this device?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(delete_device_id);
    
                $.ajax({
                    url: "./actions/delete_devices.php",
                    type: "POST",
                    dataType: 'JSON',
                    data: { 
                        delete_device_id: delete_device_id,
                    },
                    success: function(response) { 
                        console.log(response);
                        Swal.fire({
                            title: response.status === 'success' ? 'Deleted!' : 'Error!',
                            text: response.message,
                            icon: response.status,
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) { 
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });

    $(".delete_other_device").click(function(e){
        e.preventDefault();
    
        var delete_other_device_id = $(this).attr('delete_other_device_id');
        var device_type = $(this).attr('device_type');
    
        Swal.fire({
            title: 'Delete Device?',
            text: 'Are you sure you want to delete this '+device_type+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(delete_other_device_id);
    
                $.ajax({
                    url: "./actions/delete_other_devices.php",
                    type: "POST",
                    dataType: 'JSON',
                    data: { 
                        delete_other_device_id: delete_other_device_id,
                    },
                    success: function(response) { 
                        console.log(response);
                        Swal.fire({
                            title: response.status === 'success' ? 'Deleted!' : 'Error!',
                            text: response.message,
                            icon: response.status,
                        });
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) { 
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred: ' + error,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    });

    if (localStorage.getItem('nightMode') === 'enabled') {
        $("body").addClass('bg-dark text-white');
        $(".card").addClass('bg-dark text-white');
        $(".table.dataTable tbody tr").addClass('bg-dark text-white');
        $(".table.table thead th").addClass('bg-dark text-white');
        $('.dataTables_info,.dataTables_length,.dataTables_filter,.dataTables_paginate').addClass('text-white');
    }

    $("body").fadeIn(0);

    $("#nightMode").click(function(){
		$("body").toggleClass('bg-dark text-white');
        $(".card").toggleClass('bg-dark text-white');
        $(".table.dataTable tbody tr").toggleClass('bg-dark text-white');
        $(".table.table thead th").toggleClass('bg-dark text-white');
        $('.dataTables_info, .dataTables_length,.dataTables_filter,.dataTables_paginate').toggleClass('text-white');

        if ($("body").hasClass("bg-dark text-white")) {
            localStorage.setItem("nightMode","enabled");
        } else {
            localStorage.setItem("nightMode",'disabled');
        }
	});
    
});