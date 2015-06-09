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
            <article class="col-xs-9">
                <!-- <div style="text-align: center;margin-bottom: 16px;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#garrageModal">ADD NEW garrage</button>
                </div> -->
                <table class="table table-hover tablesorter" id="tbl_garrage">
                    <thead style="border-bottom: 3px solid #BDBDBD;background-color: #fff;">
                        <tr>
                            <th>#</th>
                            <th>Garrage Name</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $garrage->num_rows() > 0 ) {  $cnt = 0; ?>
                        <?php foreach ($garrage->result() as $_garrage) { $cnt++; $json_garrage[$_garrage->garrage_id] = $_garrage; ?>
                        <tr>
                            <td><?=$cnt?></td>
                            <td><?=strtoupper($_garrage->garrage_name)?></td>
                            <td><?=strtoupper($_garrage->garrage_location)?></td>
                            <td>
                                <a href="#garrageModal" data-toggle="modal" data-target="#garrageModal" data-id="<?=$_garrage->garrage_id?>" ><i class="fa fa-eye"></i></a> &nbsp;
                                <!-- <a href="#garrageModal" data-toggle="modal" data-target="#garrageModal" data-id="<?=$_garrage->garrage_id?>" ><i class="fa fa-trash-o"></i></a> -->
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
            <aside class="col-xs-3">
                <?=@$chat;?>
            </aside>
        </div>
    </main>
</div>
<!-- Modal -->
<div class="modal fade" id="garrageModal" tabindex="-1" role="dialog" aria-labelledby="garrageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="garrageModalLabel">ADD NEW GARRAGE</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalGarrage" method="POST" action="<?=dashboard_url('administrator/ajax')?>">
                    <input type="hidden" id="action" name="action" value="create">
                    <input type="hidden" id="garrage_id" name="garrage_id" value="">
                    <div class="form-group">
                        <label for="fname" class="col-xs-4 control-label">Garrage Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control garrage-field" id="garrage_name" name="garrage_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Address</label>
                        <div class="col-xs-8">
                            <textarea class="form-control garrage-field" id="garrage_location" name="garrage_location" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="btnModalGarrageSave" type="button" onclick="$('#frmModalGarrage').submit()" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var garrage_data = <?php echo count($json_garrage) > 0 ? json_encode( $json_garrage ) : '[]'; ?>;
</script>