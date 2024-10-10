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
            <form method="post" id="frmEditDevice">
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


  <div class="modal fade" id="edit_other_devices_modal" tabindex="-1" role="dialog" aria-labelledby="editDevicesLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header betson-color white-text">
          <h5 class="modal-title" id="editDevicesLabel">Edit Other Devices</h5>
          <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" id="frmEditDevice">
                <div class="row">
                    <input type="text" name="edit_other_device_id" id="edit_other_device_id" hidden>
                    <?php
                      $edit_device_form = array(
                        "edit_brand"=>"Brand",
                        "edit_model"=>"Model",
                        "edit_serial_number"=>"Serial Number",
                      );
                          foreach ($edit_device_form as $dfkey => $dfvalue) {
                              echo "
                              <div class='col-md-6'>
                                  <small class='mt-2'>".$dfvalue."</small>
                                  <input class='form-control form-control-sm' type='text' name='".$dfkey."' id='".$dfkey."'>
                              </div>";
                          }
                    ?>
                    <div class="col-md-6">
                      <small class="mt-2">Device Type</small>
                      <select class="form-control form-control-sm" name="edit_type" id="edit_type">
                        <option value="">Select Device Type</option>
                        <?php
                          $device_type=array("Laptop","Printer","Modem","Router","Switch","UPS","AVR","Aircon");
                          sort($device_type);
                          foreach ($device_type as $type) {
                            echo "<option value='".$type."'>".$type."</option>";
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6">
                        <small class="mt-2">Inventory Number</small>
                        <input class="form-control form-control-sm" type="text" name="edit_inventory_number" id="edit_inventory_number">
                    </div>
                    <button type="submit" class="btn btn-success ml-auto" name="save_other_devices" id="save_other_devices">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>