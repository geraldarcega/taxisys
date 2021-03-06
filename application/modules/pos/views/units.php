<?php
	$pos_data = array();
	$drivers_data = array();
	$day = strtoupper( date('D') );
	$day = $day == 'THU' ? $day.'R' : $day;
?>
	<main class="mainContainer" id="garage_wrapper">
		<?php foreach ( $groups as $key => $val ) { ?>
		<div class="Units">
			<div class="thisDay">
				<h4 class="allday <?php echo $val; ?>"><?php echo $key; ?></h4>
			</div>
			<!-- thisDay -->
			<?php if( $units[$val]->num_rows() ) { $i=0; ?>
			<?php foreach ($units[$val]->result() as $unit) { $unit_id = ( is_null($unit->unit_id) ? 0 : $unit->unit_id ); $pos_data[$unit_id] = $unit; ?>
			<?php if( ($i % 6) == 0 ){ ?>
			<div class="row">
			<?php } ?>
				<div class="col col-lg-2 col-sm-6">
					<div class="panel panel-pos <?php echo unitStatusClass($unit->unit_status); ?>" id="taxi_<?=$unit_id?>" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit_id?>" data-type="<?=$unit->unit_status?>" data-coding="<?=constant("DAY_{$day}") == $unit->coding_day ? 'yes' : 'no';?>" data-odometer="<?=$unit->odometer?>" data-backdrop="static">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-12 dash-units">
									<div class="huge"><i class="fa fa-taxi"></i> <?=strtoupper($unit->plate_number)?></div>
								</div>
							</div>
						</div>
						<div class="panel-body panel-nametag"><?=$unit->nickname != '' ? ucwords($unit->nickname) : 'No Driver'?></div>
					</div>
				</div>
			<?php if( ($i % 6) == 5 || $units[$val]->num_rows() == ($i+1) ){ ?>	
			</div>
			<?php } ?>
			<?php $i++; } ?>
			<?php } ?>
			<!-- row -->
		</div>
		<!-- units -->
		<?php } ?>
	</main>
</div>
<!-- Modal -->
<div class="modal fade" id="unitsModal" tabindex="-1" role="dialog" aria-labelledby="unitsModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="unitsModalLabel">UNIT - ABC 123</h4>
			</div>
			<div class="modal-body">
				<div id="maintenance_notification" class="alert alert-info" role="alert" style="display: none;">
					<strong>Oops!</strong> This unit is under maintenance, click <a href="" target="_blank">here</a> to update its status.
				</div>
				<form class="form-horizontal" id="frmModalPOS" method="POST" action="<?=base_url('pos/ajax')?>">
					<input type="hidden" name="action" id="action" value="">
					<input type="hidden" name="unit_id" id="unit_id" value="">
					<input type="hidden" name="old_driver" id="old_driver" value="">
					<input type="hidden" name="old_status" id="old_status" value="">
					<input type="hidden" name="coding_day" id="coding_day" value="">
					<input type="hidden" name="late_payment" id="late_payment" value="0">
					<input type="hidden" name="odometer" id="odometer" value="0">

					<div class="form-group">
						<label for="date" class="col-xs-3 control-label">Date</label>
						<div class="col-xs-9">
                            <input type='text' class="form-control unit-field open-datetimepicker" id="actual_date" name="actual_date" style="display:none;" placeholder="Enter actual date"/>
							<span id="date_now" style="padding-top: 7px; display: inline-block;"><?php echo date('M d, Y'); ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="driver" class="col-xs-3 control-label">Driver</label>
						<div class="col-xs-9">
							<select class="form-control" id="select_driver" name="select_driver" required>
								<option value="">----</option>
                                <?php if( $drivers->num_rows() ) { ?>
                                <?php foreach ($drivers->result() as $driver) { $drivers_data[$driver->id] = $driver; ?>
                                <option value="<?=$driver->id?>"><?=$driver->first_name?> <?=$driver->last_name?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
						</div>
					</div>
					<div class="form-group onduty-input payment-input">
						<label for="rate_type" class="col-xs-3 control-label">Rate</label>
						<div class="col-xs-9" id="rate_input">
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-primary active"> <input type="radio" name="rate_type" id="rate_type1" value="<?=BTYPE_REGULAR?>" autocomplete="off">
									Regular
								</label>
								<label class="btn btn-primary"> <input type="radio" name="rate_type" id="rate_type4" value="<?=BTYPE_HOLIDAY?>" autocomplete="off">
									Holiday
								</label>
								<label id="coding" class="btn btn-primary"> <input type="radio" name="rate_type" id="rate_type2" value="2" autocomplete="off">Coding</label>
							</div>
						</div>
					</div>
					<div class="form-group onduty-input payment-input">
						<label for="boundary" class="col-xs-3 control-label">Boundary</label>
						<div class="col-xs-9">
							<input type="number" class="form-control" id="boundary" name="boundary" placeholder="1500" maxlength="5" required>
						</div>
					</div>
					<div class="form-group onduty-input payment-input">
						<label for="drivers_fund" class="col-xs-3 control-label">Driver's fund</label>
						<div class="col-xs-9">
							<input type="number" class="form-control" id="drivers_fund" name="drivers_fund" maxlength="3" placeholder="50">
						</div>
					</div>
					<div class="form-group onduty-input payment-input">
						<label for="short" class="col-xs-3 control-label">Short</label>
						<div class="col-xs-9">
							<input type="number" class="form-control" id="short" name="short" maxlength="5">
						</div>
					</div>
					<div class="form-group">
						<label for="remarks" class="col-xs-3 control-label">Remarks</label>
						<div class="col-xs-9">
							<textarea class="form-control" name="remarks" id="remarks"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="remarks" class="col-xs-3 control-label">Status</label>
						<div class="col-xs-5">
							<select id="status" name="status" class="form-control" required>
								<option value="<?=UNIT_DUTY?>">On-duty</option>
								<option value="<?=UNIT_GARAGE?>">On-garage</option>
								<option value="<?=UNIT_MAINTENANCE?>">On-maintenance</option>*
							</select>
						</div>
					</div>
					<div id="maintenance_opt" class="form-group">
						<label for="remarks" class="col-xs-3 control-label">Select Maintenance</label>
						<div class="col-xs-9">
							<table class="table">
								<thead>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Interval</th>
										<th>Price</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody>
							<?php
								$maintenance = Modules::run( 'dashboard/maintenance/get_maintenance', array( 'wh|is_scheduled' => 1 ), true );
								if( count($maintenance) )
								{
									foreach ($maintenance as $key => $value) {
							?>
								<tr>
									<td><input type="radio" name="maintenance_id" id="maintenance_<?php echo $value['id']; ?>" value="<?php echo $value['id']; ?>" required></td>
									<td><?php echo $value['name']; ?></td>
									<td><?php echo $value['interval_value']; ?></td>
									<td><?php echo $value['price']; ?></td>
									<td>
										<a id="m_info_link_<?php echo $value['id']; ?>" href="javascript:show_maintenance_info('<?php echo $value['id']; ?>');" rel="tooltip" data-original-title="Info"><i class="fa fa-info-circle"></i></a>
									</td>
								</tr>
								<tr id="maintenance_info_<?php echo $value['id']; ?>" class="maintenance-info" style="display: none;">
		                        	<td colspan="4">
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
		                        					if( count($value['parts']) > 0 ){
		                        						for ( $i=0; $i < count($value['parts']); $i++) {
	                        					?>
		                        				<tr>
		                        					<td><?php echo $value['parts'][$i]['name']; ?></td>
		                        					<td><?php echo $value['parts'][$i]['count']; ?></td>
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
							<?php
									}
								}
								else
								{
							?>
								<tr>
									<td colspan="4">
										<div class="alert alert-info">No maintenance found!</div>
									</td>
								</tr>
							<?php
								}
							?>
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button id="btnModalUnitLate" type="button" class="btn btn-warning" onclick="show_payment_fields( 0, null, null);">Late Payment</button>
				<button id="btnModalUnitsave" type="button" class="btn btn-primary" onclick="$('#frmModalPOS').submit();" data-loading-text="Saving...">Save</button>
				<button id="btnModalUnitCancel" type="button" class="btn btn-danger onduty-input" onclick="void_pos();" data-loading-text="Loading..." >Void</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var pos_json = <?=!empty($pos_data) ? json_encode($pos_data) : '[]'?>;
    var drivers_json = <?=$drivers->num_rows() ? json_encode($drivers_data) : '[]'?>;
</script>