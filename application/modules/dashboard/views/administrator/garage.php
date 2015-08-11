    <!-- /.row -->
    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-12">
                <!-- <div style="text-align: center;margin-bottom: 16px;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#garageModal">ADD NEW garage</button>
                </div> -->
                <table class="table table-striped tablesorter" id="tbl_garage">
                    <thead style="border-bottom: 3px solid #BDBDBD;background-color: #fff;">
                        <tr>
                            <th>#</th>
                            <th>Garage Name</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $garage->num_rows() > 0 ) {  $cnt = 0; ?>
                        <?php foreach ($garage->result() as $_garage) { $cnt++; $json_garage[$_garage->garage_id] = $_garage; ?>
                        <tr>
                            <td><?=$cnt?></td>
                            <td><?=strtoupper($_garage->garage_name)?></td>
                            <td><?=strtoupper($_garage->garage_location)?></td>
                            <td>
                                <a href="#garageModal" data-toggle="modal" data-target="#garageModal" data-id="<?=$_garage->garage_id?>" ><i class="fa fa-eye"></i></a> &nbsp;
                                <!-- <a href="#garageModal" data-toggle="modal" data-target="#garageModal" data-id="<?=$_garage->garage_id?>" ><i class="fa fa-trash-o"></i></a> -->
                            </td>
                        </tr>                        
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="4"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No records found!</div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </article>
        </div>
    </main>
</div>
<!-- Modal -->
<div class="modal fade" id="garageModal" tabindex="-1" role="dialog" aria-labelledby="garageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="garageModalLabel">ADD NEW GARAGE</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalGarage" method="POST" action="<?=dashboard_url('administrator/ajax')?>">
                    <input type="hidden" id="action" name="action" value="create">
                    <input type="hidden" id="garage_id" name="garage_id" value="">
                    <div class="form-group">
                        <label for="fname" class="col-xs-4 control-label">Garage Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control garage-field" id="garage_name" name="garage_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Address</label>
                        <div class="col-xs-8">
                            <textarea class="form-control garage-field" id="garage_location" name="garage_location" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="btnModalGarageSave" type="button" onclick="$('#frmModalGarage').submit()" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var garage_data = <?php echo count($json_garage) > 0 ? json_encode( $json_garage ) : '[]'; ?>;
</script>