<?php $unit_id = $unit->unit_id; ?>
<main class="mainContainer">
        <div class="row" style="padding:10px 0px;">
            <article class="col-xs-3">
                <strong id="odotitle">Current Odometer <span id="odomsg" class="label label-info" style="display:none;">Updated!</span></strong>
                <div class="input-group col-xs-8">
                    <input type="text" id="new_odometer_<?=$unit_id?>" class="form-control" placeholder="odometer" value="<?=$unit->odometer?>">
                    <span class="input-group-btn">
                        <button class="btn btn-primary btnUpdateOdo" type="button" data-id="<?=$unit_id?>">Update</button>
                    </span>
                </div>
            </article>
        </div>
        <div class="row">
            <article class="col-xs-12">
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
                    			if( count($maintenance) ){
                    				foreach( $maintenance as $maintain ) {
										$past = isset($unit->maintenance['past'][ $unit_id ][ $maintain['id'] ]) ? $unit->maintenance['past'][ $unit_id ][ $maintain['id'] ] : '';
                    		?>
                    		<tr>
	                            <td><?php echo $maintain['name']; ?></td>
	                            <td>Every <?php echo number_format($maintain['interval_value']); ?> <?=maintenanceInterval($maintain['interval'])?></td>
	                            <td><?php echo $past != '' ? date( 'M d, Y H:i', strtotime($past->date_from .' '. $past->time_from) ) : ''; ?></td>
	                            <td><?php echo $past != '' ? $past->odometer : ''; ?></td>
	                            <td>
	                            	<?php 
	                            		if( $maintain['interval'] != Maintenance_model::INTERVAL_ODOMETER )
	                            		{
	                            			if( $maintain['interval'] == Maintenance_model::INTERVAL_WEEKLY )
	                            				$interval = '+'.$maintain['interval_value'].' weeks';
	                            			 
	                            			if( $maintain['interval'] == Maintenance_model::INTERVAL_MONTHLY )
	                            				$interval = '+'.$maintain['interval_value'].' months';
	                            			
	                            			if( $past != '' )
	                            			{
	                            				$d = new DateTime( $past->prefered_date );
	                            				
	                            				$d->modify( $interval );
	                            				echo $d->format("M d, Y");
	                            			}
	                            			else
											{												
												$d = new DateTime($interval);
												echo $d->format("M d, Y");
											}
	                            		}
                            		?>
	                            </td>
	                            <td>
	                            	<?php 
	                            		if( $maintain['interval'] == Maintenance_model::INTERVAL_ODOMETER )
	                            		{
	                            			if( $past != '' )
	                            				echo $past->odometer + $maintain['interval_value'];
	                            			else
	                            				echo $maintain['interval_value'];
	                            		}
                            		?>
                            	</td>
	                            <td>
	                            	<a href="javascript:show_maintenance_info('<?php echo $maintain['id']; ?>');" rel="tooltip" data-original-title="Info"><i class="fa fa-info-circle"></i></a> &nbsp;
	                            	<?php if( $unit->unit_status != UNIT_DUTY ) { ?>
	                            	<a href="#maintenanceModal" data-toggle="modal" data-target="#maintenanceModal" data-id="<?php echo $maintain['id']; ?>" rel="tooltip" rel="tooltip" data-original-title="<?php echo isset($unit->maintenance['ongoing'][ $unit_id ][ $maintain['id'] ]) ? 'On-going' : 'Apply';?>">
	                            		<?php echo !isset($unit->maintenance['ongoing'][ $unit_id ][ $maintain['id'] ]) ? '<i class="fa fa-caret-square-o-right"></i>' : '<i class="fa fa-gears"></i>';?>
	                            	</a>
	                            	<?php } ?>
                            	</td>
	                        </tr>
	                        <tr id="maintenance_info_<?php echo $maintain['id']; ?>" class="maintenance-info" style="display: none;">
	                        	<td colspan="8">
	                        		<h4>Parts Included</h4>
	                        		<table class="table table-condensed">
	                        			<thead>
	                        				<tr>
	                        					<th>Name</th>
	                        					<th>Count</th>
	                        				</tr>
	                        			</thead>
	                        			<tbody>
	                        				<?php 
	                        					if( count($maintain['parts']) > 0 ){
	                        						for ( $i=0; $i < count($maintain['parts']); $i++) {
                        					?>
	                        				<tr>
	                        					<td><?php echo $maintain['parts'][$i]['name']; ?></td>
	                        					<td><?php echo $maintain['parts'][$i]['count']; ?></td>
	                        				</tr>
	                        				<?php } } else { ?>
	                        				<tr>
	                        					<td colspan="2">
	                        						<div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No parts included!</div>
	                        					</td>
	                        				</tr>
	                        				<?php } ?>
	                        			</tbody>
	                        		</table>
	                        	</td>
	                        </tr>
<!--                         <tr id="notes_<?php echo $maintain['id']; ?>" style="display: none;">
<!-- 	                        	<td colspan="8"> -->
<!-- 	                        		<div class="form-group"> -->
<!-- 		                                <label for="reg_rate" class="col-xs-2 control-label">Notes</label> -->
<!-- 		                                <div class="col-xs-10"> -->
<!-- 		                                    <textarea class="form-control" rows="5" style="resize:none;"></textarea>
<!-- 		                                </div> -->
<!-- 		                            </div> -->
<!-- 	                        	</td> -->
<!-- 	                        </tr> -->
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
                <h4 class="modal-title" id="maintenanceModalLabel">SET-UP MAINTENANCE:</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalMaintenance" method="post" action="<?=dashboard_url('units/ajax')?>">
                    <input type="hidden" name="action" id="action" value="apply_maintenance">
                    <input type="hidden" name="unit_maintenance_id" id="unit_maintenance_id" value="">
                    <input type="hidden" name="maintenance_id" id="maintenance_id" value="">
                    <input type="hidden" name="unit_id" id="unit_id" value="<?=$unit_id?>">
                    <input type="hidden" name="m_odometer" id="m_odometer" value="<?=$unit->odometer?>">
                    
                    <div class="form-group">
						<label for="rate_type" class="col-xs-3 control-label">Multi-day</label>
						<div class="col-xs-3">
							<input id="multi_day" name="multi_day" type="checkbox" checked="" data-size="small" data-on-text="Yes" data-off-text="No">
						</div>
						<label for="allday" class="col-xs-2 control-label">All day</label>
						<div class="col-xs-3">
							<input id="allday" name="allday" type="checkbox" value="1" checked="" data-size="small" data-on-text="Yes" data-off-text="No">
						</div>
					</div>
                    <div class="form-group">
                        <label for="prefered_date_dp" class="col-xs-3 control-label">From Date & Time</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="date_from_dp">
                                <input type='text' class="form-control unit-field" id="date_from" name="date_from" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-4 time_field">
                            <div class="input-group date" id="time_from_dp">
                                <input type='text' class="form-control unit-field" id="time_from" name="time_from" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group datetime_to">
                        <label for="prefered_date_dp" class="col-xs-3 control-label">To Date & Time</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="date_to_dp">
                                <input type='text' class="form-control unit-field" id="date_to" name="date_to" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="input-group date time_field" id="time_to_dp">
                                <input type='text' class="form-control unit-field" id="time_to" name="time_to" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-xs-3 control-label">Notes</label>
                        <div class="col-xs-9">
                            <textarea id="notes" name="notes" rows="5" class="form-control" style="resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="form-group status-fld">
                        <label for="notes" class="col-xs-3 control-label">Status</label>
                        <div class="col-xs-5">
                            <select class="form-control" id="status" name="status">
                            	<option value="">----</option>
                            	<option value="<?php echo Maintenance_model::STATUS_DONE; ?>">Completed</option>
                            	<option value="<?php echo Maintenance_model::STATUS_CANCELLED; ?>">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnModalMaintenanceSave" onclick="$('#frmModalMaintenance').submit()" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">Save</button>
            	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var maintenance_data = <?php echo count($maintenance) ? json_encode($maintenance) : '[]'; ?>;
    var unit_data = <?php echo count($unit) ? json_encode($unit) : '[]'; ?>;
</script>