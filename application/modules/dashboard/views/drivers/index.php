<?php $search = $this->input->get('search'); $column = $this->input->get('column'); $limit = $this->input->get('limit'); ?>
    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-12">
                <div id="filter_wrapper" style="margin-bottom:10px;display:none;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Filter
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="get" action="">
                                <div class="form-group">
                                    <div class="row">               
                                        <div class="col-xs-6">
                                            <label for="column" class="col-xs-2 control-label">Search</label>
                                            <div class="col-xs-10">
                                                <input type="text" class="form-control" id="search" placeholder="Search here.." <?php echo $column == 'status' ? 'style="display:none;"' : 'name="search"'; ?> value="<?php echo $search; ?>">
                                                <select class="form-control" id="search" <?php echo $column == 'status' ? 'name="search"' : 'style="display:none;"'; ?>>
                                                    <option value="1" <?php echo $search == '1' ? 'selected' : ''; ?>>On Duty</option>
                                                    <option value="2" <?php echo $search == '2' ? 'selected' : ''; ?>>Off Duty</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <label for="column" class="col-xs-1 control-label">In</label>
                                            <div class="col-xs-11">
                                                <select class="form-control" id="column" name="column">
                                                    <option value="plate_number" <?php echo $column == 'plate_num' ? 'selected' : ''; ?>>Plate #</option>
                                                    <option value="name" <?php echo $column == 'name' ? 'selected' : ''; ?>>Name</option>
                                                    <option value="status" <?php echo $column == 'status' ? 'selected' : ''; ?>>Status</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">               
                                        <div class="col-xs-6">
                                            <label for="column" class="col-xs-2 control-label">Limit</label>
                                            <div class="col-xs-4">
                                                <select class="form-control" id="limit" name="limit">
                                                    <option value="10" <?php echo $limit == '10' ? 'selected' : ''; ?>>Default (10)</option>
                                                    <option value="20" <?php echo $limit == '20' ? 'selected' : ''; ?>>20</option>
                                                    <option value="30" <?php echo $limit == '30' ? 'selected' : ''; ?>>30</option>
                                                    <option value="40" <?php echo $limit == '40' ? 'selected' : ''; ?>>40</option>
                                                    <option value="50" <?php echo $limit == '50' ? 'selected' : ''; ?>>50</option>
                                                    <option value="all" <?php echo $limit == 'all' ? 'selected' : ''; ?>>All</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12" style="text-align: center;">
                                        <button type="submit" class="btn btn-primary">Filter</button>&nbsp;&nbsp;
                                        <button type="button" class="btn btn-danger" onclick="remove_filter('<?=uri_string()?>')">Remove Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-striped tablesorter" id="tbl_drivers">
                    <thead style="border-bottom: 3px solid #BDBDBD;background-color: #fff;">
                        <tr>
                            <th>#</th>
                            <th>Current Unit</th>
                            <th>Nickname</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>On-duty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $drivers->num_rows() > 0 ) {  $cnt = 0; ?>
                        <?php foreach ($drivers->result() as $driver) { $cnt++; $json_drivers[$driver->id] = $driver; ?>
                        <tr>
                            <td><?=$cnt?></td>
                            <td><?=strtoupper($driver->plate_number)?></td>
                            <td><?=ucwords($driver->nickname)?></td>
                            <td><?=ucwords($driver->first_name)?></td>
                            <td><?=ucwords($driver->last_name)?></td>
                            <td><?=driverStatus($driver->status)?></td>
                            <td align="center">
                            	<a href="#driversModal" data-toggle="modal" data-target="#driversModal" data-id="<?=$driver->id?>" rel="tooltip" data-original-title="View/Update"><i class="fa fa-eye"></i></a>
                            	&nbsp;
                            	<a href="javascript:remove('<?=$driver->id?>', 1);" ><i class="fa fa-archive" rel="tooltip" data-original-title="Archive"></i></a>
                            	&nbsp;
                            	<a  href="javascript:remove('<?=$driver->id?>', 0);"><i class="fa fa-trash" rel="tooltip" data-original-title="Remove"></i></a>
                            </td>
                        </tr>                        
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="7"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No records found!</div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?=isset($pagination) ? $pagination : '';?>
            </article>
        </div>
    </main>
</div>
<!-- Modal -->
<div class="modal fade" id="driversModal" tabindex="-1" role="dialog" aria-labelledby="driversModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="driversModalLabel">ADD NEW DRIVER</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalDriver" method="POST" action="<?=dashboard_url('drivers/ajax')?>">
                    <input type="hidden" id="action" name="action" value="create">
                    <input type="hidden" id="driver_id" name="driver_id" value="">
                    <div class="form-group">
                        <label for="unit" class="col-xs-4 control-label">Unit</label>
                        <div class="col-xs-4">
                            <select id="unit" name="unit" class="form-control driver-field">
                                <option value="">----</option>
                                <?php if( $avail_units->num_rows() ){ ?>
                                <?php foreach( $avail_units->result() as $unit ){ ?>
                                <option value="<?=$unit->unit_id?>"><?=strtoupper($unit->plate_number)?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="col-xs-4 control-label">Full Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control driver-field" id="first_name" name="first_name" placeholder="First name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="col-xs-4 control-label">&nbsp;</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control driver-field" id="middle_name" name="middle_name" placeholder="Middle name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col-xs-4 control-label">&nbsp;</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control driver-field" id="last_name" name="last_name" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nickname" class="col-xs-4 control-label">Nickname</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control driver-field" id="nickname" name="nickname" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="birthday" class="col-xs-4 control-label">Birth Date</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="birthday_dp">
                                <input type="text" class="form-control driver-field open-datetimepicker" id="birthday" name="birthday" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Address</label>
                        <div class="col-xs-8">
                            <textarea class="form-control driver-field" id="address" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">SSS</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control driver-field" id="sss" name="sss">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Philhealth</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control driver-field" id="philhealth" name="philhealth">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Pagibig</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control driver-field" id="pagibig" name="pagibig">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="btnModalDriversave" type="button" onclick="$('#frmModalDriver').submit()" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var drivers_data = <?php echo $drivers->num_rows() ? json_encode( $json_drivers ) : '[]'; ?>;
</script>