<div class="modal fade" id="add_devices_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header primary-color text-white">
        <h5 class="modal-title w-100 text-white">Add Devices</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
                        <div class='col-md-6'>
                            <div class='md-form'>
                                <input class='form-control' type='text' name='".$dfkey."' id='".$dfkey."'>
                                <label for='".$dfkey."'>".$dfvalue."</label>
                            </div>
                        </div>";
                    }
                  ?>

            </div>
            <button type="submit" class="btn btn-primary btn-md" name="add_devices" id="add_devices">Add</button>
          </form>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-elegant btn-sm" data-dismiss="modal" title="Close">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_devices_modal" tabindex="-1" role="dialog" aria-labelledby="editDevicesLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header betson-color white-text">
          <h5 class="modal-title" id="editDevicesLabel">Edit Devices</h5>
          <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" id="frmEditTask">
                <div class="row">
                    <input type="text" name="edit_device_id" id="edit_device_id" hidden>
                    <?php
                      $edit_device_form = array(
                        "edit_cubicle_number"=>"Cubicle Number",
                        "edit_assigned_agent"=>"Assigned Agent",
                        "edit_system_unit"=>"System Unit",
                        "edit_monitor"=>"Monitor",
                        "edit_keyboard"=>"Keyboard",
                        "edit_mouse"=>"Mouse",
                        "edit_headset"=>"Headset");
                          foreach ($edit_device_form as $dfkey => $dfvalue) {
                              echo "
                              <div class='col-md-6'>
                                  <small class='mt-2'>".$dfvalue."</small>
                                  <input class='form-control form-control-sm' type='text' name='".$dfkey."' id='".$dfkey."'>
                              </div>";
                          }
                    ?>
                    <button type="submit" class="btn btn-success ml-auto" name="save_devices" id="save_devices">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>