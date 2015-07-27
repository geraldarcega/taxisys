    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-12">
                <!-- <div class="dash-border Units"> -->
                <table id="tbl_all_units" class="table table-striped tablesorter">
                    <thead style="background-color:#fff;">
                        <tr>
                            <th>#</th>
                            <th>Plate #</th>
                            <th>Year Model</th>
                            <th>Coding Day</th>
                            <th>Franchise Until</th>
                            <th>Renew By</th>
                            <th>Odometer</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $units->num_rows() ) { $i = 0; ?>
                        <?php foreach ($units->result() as $unit) { $i++; $json_units[$unit->unit_id] = $unit; ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=strtoupper($unit->plate_number)?></td>
                            <td><?=$unit->year_model?></td>
                            <td><?=codingDay($unit->coding_day)?></td>
                            <td><?=dateFormat($unit->franchise_until, 'M d, Y')?></td>
                            <td><?=dateFormat($unit->renew_by, 'M d, Y')?></td>
                            <td id="odometer_<?=$unit->unit_id?>"><?=number_format($unit->odometer)?></td>
                            <td><?=unitStatus($unit->unit_status)?></td>
                            <td>
                            	<div id="units_opt_<?php echo $unit->unit_id; ?>">
                            		<a href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" rel="tooltip" data-original-title="Details"><i class="fa fa-eye"></i></a> &nbsp;
	                                <a href="#maintenanceModal" data-toggle="modal" data-target="#maintenanceModal" data-id="<?=$unit->unit_id?>" rel="tooltip" data-original-title="Maintenance"><i class="fa fa-wrench"></i></a> &nbsp;
	                                <a href="javascript:show_odometer('<?=$unit->unit_id?>');" rel="tooltip" data-original-title="Odometer"><i class="fa fa-tachometer"></i></a>
                            	</div>
                            	<div id="input_odometer_<?=$unit->unit_id?>" style="width: 130px;display: none;">
                            		<div class="input-group">
					                    <input type="text" id="odometer" name="odometer" class="form-control input-sm" value="<?=$unit->odometer?>">
					                    <span class="input-group-btn">
					                        <button class="btn btn-primary btn-sm" type="button" data-id="<?=$unit->unit_id?>" id="btnUpdateOdo">Update</button>
					                    </span>
					                </div>
                            		<a style="float: right;margin-top: -25px;margin-right: -15px;" href="javascript:show_odometer('<?=$unit->unit_id?>');" rel="tooltip" data-original-title="Close"><i class="fa fa-times"></i></a>
                            	</div>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="8"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No units found!</div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- </div> -->
            </article>
        </div>
    </main>
</div>
<!-- Details Modal -->
<div class="modal fade" id="unitsModal" tabindex="-1" role="dialog" aria-labelledby="unitsModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:850px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="unitsModalLabel">ADD NEW UNIT</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalUnits" method="post" action="<?=dashboard_url('units/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create">
                    <input type="hidden" name="unit_id" id="unit_id" value="">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="plate_number" class="col-xs-4 control-label">Plate #</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control unit-field" id="plate_number1" name="plate_number1" maxlength="3" required placeholder="AAA">
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control unit-field" id="plate_number2" name="plate_number2" maxlength="4" required placeholder="123">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="year_model" class="col-xs-4 control-label">Year Model</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="year_model_dp">
                                        <input type="text" class="form-control unit-field" id="year_model" name="year_model" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Coding Day</label>
                                <div class="col-xs-8">
                                    <select id="coding_day" name="coding_day" class="form-control unit-field" required>
                                        <option value="">----</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Resealing Date 1</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="resealing_date1_dp">
                                        <input type='text' class="form-control unit-field" id="resealing_date1" name="resealing_date1" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Resealing Date 2</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="resealing_date2_dp">
                                        <input type='text' class="form-control unit-field" id="resealing_date2" name="resealing_date2" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Franchise Until</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="franchise_until_dp">
                                        <input type='text' class="form-control unit-field" id="franchise_until" name="franchise_until" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Renew By</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="renew_by_dp">
                                        <input type='text' class="form-control unit-field" id="renew_by" name="renew_by" required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Regular Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="reg_rate" name="reg_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Sunday Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="sunday_rate" name="sunday_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Holiday Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="holiday_rate" name="holiday_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Coding Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="coding_rate" name="coding_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Overhead Fund</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="overhead_fund" name="overhead_fund" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Docs Fund</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="docs_fund" name="docs_fund" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Replacement Fund</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="replacement_fund" name="replacement_fund" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnModalUnitsave" onclick="$('#frmModalUnits').submit()" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Details Modal -->
<div class="modal fade" id="maintenanceModal" tabindex="-1" role="dialog" aria-labelledby="maintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="maintenanceModalLabel">UNIT MAINTENANCE</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalMaintenance" method="post" action="<?=dashboard_url('units/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create_maintenance">
                    <input type="hidden" name="unit_id" id="unit_id" value="<?=$this->uri->segment('5')?>">
                    <table id="tbl_all_maintenance" class="table table-striped tablesorter">
	                    <thead style="background-color:#fff;">
	                        <tr>
	                            <th>Maintenance</th>
	                            <th>Interval</th>
	                            <th>Last Date</th>
	                            <th>Last Odometer</th>
	                            <th>Next Date</th>
	                            <th>Next Odometer</th>
	                            <th>&nbsp;</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php 
                    			if( $maintenance->num_rows() ){
                    				foreach( $maintenance->result() as $maintain ) {
                    		?>
                    		<tr>
	                            <td><?php echo $maintain->name; ?></td>
	                            <td>Every <?php echo number_format($maintain->interval_value); ?> <?=maintenanceInterval($maintain->interval)?></td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td></td>
	                            <td><a href="#" rel="tooltip" data-original-title="Apply"><i class="fa fa-caret-square-o-right"></i></a></td>
	                        </tr>
	                    	<?php 
                    				} 
                    			}
                    			else{
                    		?>
                    		<tr>
	                            <td colspan="8"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No maintenance found!</div></td>
	                        </tr>
                    		<?php } ?>
	                    </tbody>
	                </table>
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
    var units_data = <?php echo $units->num_rows() ? json_encode( $json_units ) : '[]'; ?>;
    //var maintenance_data = <?php //echo isset($maintenance) ? $maintenance : '[]'; ?>;
</script>