    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-12">
                <table id="tbl_all_maintenance" class="table table-striped tablesorter">
                    <thead style="background-color:#fff;">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Interval</th>
                            <th>Scheduled</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( count($maintenance) > 0 ) { $i = 0; ?>
                        <?php foreach ($maintenance as $_m) { $i++; $json_maintenance[$_m['id']] = $_m; ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=ucwords($_m['name'])?></td>
                            <td>Every <?=number_format($_m['interval_value'])?> <?=maintenanceInterval($_m['interval'])?></td>
                            <td><?=$_m['is_scheduled'] ? 'Yes' : 'No'?></td>
                            <td>
                                <a href="#maintenanceModal" data-toggle="modal" data-target="#maintenanceModal" data-id="<?=$_m['id']?>" data-backdrop="static" rel="tooltip" data-original-title="Details"><i class="fa fa-eye"></i></a> &nbsp;
                                <a href="#" data-id="<?=$_m['id']?>" rel="tooltip" data-original-title="Remove"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="4"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No maintenance found!</div></td>
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
                <h4 class="modal-title" id="maintenanceModalLabel">ADD NEW MAINTENANCE ITEM</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalMaintenance" method="post" action="<?=dashboard_url('maintenance/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label for="plate_number" class="col-xs-3 control-label">Name</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control unit-field" id="m_type" name="m_type" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-xs-3 control-label">Scheduled</label>
                        <div class="col-xs-9">
                        	<input id="is_scheduled" name="is_scheduled" type="checkbox" checked="false" data-size="small" data-off-text="No" data-on-text="Yes" class="BSswitch" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="interval" class="col-xs-3 control-label">Interval</label>
                        <div class="col-xs-5">
                            <select id="interval" name="interval" class="form-control">
                            	<option value="1">Odometer</option>
                            	<option value="2">Monthly</option>
                            	<option value="3">Weekly</option>
                            </select>
                        </div>
                        <div class="col-xs-4">
                        	<input type="number" class="form-control unit-field" id="interval_value" name="interval_value" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-xs-3 control-label">Price</label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control unit-field" id="price" name="price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-xs-3 control-label">Parts</label>
                        <div class="col-xs-9">
                            <button type="button" class="btn btn-success" onclick="add_parts('','')"><i class="fa fa-plus"></i> Add parts</button>
                            <div id="parts_wrapper">
                                
                            </div>
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
    var maintenance_data = <?php echo count($maintenance) > 0 ? json_encode( $json_maintenance ) : '[]'; ?>;
    var parts_data = <?php echo isset($parts) ? $parts : '[]'; ?>;
</script>