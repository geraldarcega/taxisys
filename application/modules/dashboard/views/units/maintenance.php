    <main class="mainContainer">
        <div class="row" style="padding:10px 0px;">
            <article class="col-xs-2">
                <strong id="odotitle">Current Odometer</strong>
                <span id="odomsg" class="label label-info" style="display:none;">Updated!</span>
                <div class="input-group">
                    <input type="text" id="odometer" name="odometer" class="form-control" placeholder="odometer" value="<?=$unit->odometer?>">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" data-id="<?=$this->uri->segment(5)?>" id="btnUpdateOdo">Update</button>
                    </span>
                </div>
            </article>
        </div>
        <div class="row">
            <article class="col-xs-12">
                <table id="tbl_all_maintenance" class="table table-striped tablesorter">
                    <thead style="background-color:#fff;">
                        <tr>
                            <th>#</th>
                            <th>Maintenance</th>
                            <th>Current</th>
                            <th>Prev Date</th>
                            <th>Prev Odometer</th>
                            <th>Next Date</th>
                            <th>Next Odometer</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="8"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No maintenance found!</div></td>
                        </tr>
                    </tbody>
                </table>
            </article>
        </div>
    </main>
    <!-- /.row -->
</div>
<!-- Details Modal -->
<div class="modal fade" id="maintenanceModal" tabindex="-1" role="dialog" aria-labelledby="maintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="maintenanceModalLabel">ADD NEW MAINTENANCE</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalMaintenance" method="post" action="<?=dashboard_url('units/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create_maintenance">
                    <input type="hidden" name="unit_maintenance_id" id="unit_maintenance_id" value="">
                    <input type="hidden" name="unit_id" id="unit_id" value="<?=$this->uri->segment('5')?>">
                    <div class="form-group">
                        <label for="maintenance" class="col-xs-3 control-label">Maintenance</label>
                        <div class="col-xs-9">
                            <select id="maintenance" name="maintenance" class="form-control" required>
                                <option value=""> --- </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="uns_maintenance" class="col-xs-3 control-label">Maintenance</label>
                        <div class="col-xs-9">
                            <input type="text" id="uns_maintenance" name="uns_maintenance" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plate_number" class="col-xs-3 control-label">Current</label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control unit-field" id="current" name="current" placeholder="10000">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-3 control-label">Date</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="schedule_dp">
                                <input type='text' class="form-control unit-field" id="schedule" name="schedule" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="parts_included">
                        <div class="col-xs-12">
                            <h4 class="text-center">PARTS INCLUDED</h4>
                            <table id="tbl_maintenance_parts" class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnModalMaintenanceSave" onclick="$('#frmModalMaintenance').submit()" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var maintenance_data = <?php echo isset($maintenance) ? $maintenance : '[]'; ?>;
</script>