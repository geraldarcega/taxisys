<?php $unit_id = $unit->id; ?>
<main class="mainContainer">
        <div class="row" style="padding:10px 0px;">
            <article class="col-xs-3">
                <strong id="odotitle">Current Odometer <span id="odomsg" class="label label-info" style="display:none;">Updated!</span></strong>
                <div class="input-group col-xs-8">
                    <input type="text" id="odometer" name="odometer" class="form-control" placeholder="odometer" value="<?=$unit->odometer?>">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" data-id="<?=$unit_id?>" id="btnUpdateOdo">Update</button>
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
	                            <td><?php echo $past != '' ? date( 'M d, Y', strtotime($past->prefered_date) ) : ''; ?></td>
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
	                            	<?php if( $unit->status != UNIT_DUTY ) { ?>
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
                    
                    <div class="form-group" style="display:none;">
                        <label for="uns_maintenance" class="col-xs-3 control-label">Maintenance</label>
                        <div class="col-xs-9">
                            <input type="text" id="uns_maintenance" name="uns_maintenance" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prefered_date_dp" class="col-xs-3 control-label">Date & Time</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="prefered_date_dp">
                                <input type='text' class="form-control unit-field" id="prefered_date" name="prefered_date" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="input-group date" id="prefered_time_dp">
                                <input type='text' class="form-control unit-field" id="prefered_time" name="prefered_time" required/>
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
                    <div class="form-group update-flds">
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