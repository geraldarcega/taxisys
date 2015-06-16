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
                <table id="tbl_all_maintenance" class="table table-hover tablesorter">
                    <thead style="background-color:#fff;">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Interval</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No maintenance found!</div></td>
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
                <h4 class="modal-title" id="maintenanceModalLabel">ADD NEW MAINTENANCE ITEM</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalMaintenance" method="post" action="<?=dashboard_url('maintenance/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create">
                    <input type="hidden" name="unit_id" id="unit_id" value="">
                    <div class="form-group">
                        <label for="plate_number" class="col-xs-3 control-label">Type</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control unit-field" id="m_type" name="m_type" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plate_number" class="col-xs-3 control-label">Interval</label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control unit-field" id="interval" name="interval" required placeholder="12345">
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