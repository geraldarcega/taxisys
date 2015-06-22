<div id="page-wrapper">
	<?=@$page_header;?>
    <!-- /.row -->
    <?php if( $this->session->flashdata('msg') ){ ?>
    <!-- /message -->
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=$this->session->flashdata('msg')?>
    </div>
    <?php } ?>
    <?=@$top_nav;?>
    <!-- /.row -->
    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-12">
                <table id="tbl_all_maintenance" class="table table-striped tablesorter">
                    <thead style="background-color:#fff;">
                        <tr>
                            <th>#</th>
                            <th>Maintenance</th>
                            <th>Interval</th>
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
                <form class="form-horizontal" id="frmModalMaintenance" method="post" action="<?=dashboard_url('maintenance/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create">
                    <input type="hidden" name="maintenance_id" id="maintenance_id" value="">
                    <div class="form-group">
                         <label for="reg_rate" class="col-xs-3 control-label">Scheduled</label>
                         <div class="col-xs-5">
                            <input class="bs-switch" id="scheduled" name="scheduled" type="checkbox" checked data-size="small" data-on-text="Yes" data-off-text="No">
                        </div>
                    </div>
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
                        <label for="plate_number" class="col-xs-3 control-label">Interval</label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control unit-field" id="interval" name="interval" placeholder="10000">
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
    // var maintenance_data = <?php //echo $maintenance->num_rows() ? json_encode( $json_maintenance ) : '[]'; ?>;
</script>