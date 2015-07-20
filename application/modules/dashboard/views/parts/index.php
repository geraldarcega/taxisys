    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-12">
                <table id="tbl_all_parts" class="table table-striped tablesorter">
                    <thead style="background-color:#fff;">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Supplier</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Date Purchase</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $parts->num_rows() ) { $i = 0; ?>
                        <?php foreach ($parts->result() as $part) { $i++; $json_parts[$part->parts_id] = $part; ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=ucwords($part->name)?></td>
                            <td><?=ucwords($part->supplier)?></td>
                            <td>&#8369; <?=$part->price?></td>
                            <td><?=$part->stock?></td>
                            <td><?=dateFormat($part->purchase_date, 'M d, Y')?></td>
                            <td>
                                <a href="#partsModal" data-toggle="modal" data-target="#partsModal" data-id="<?=$part->parts_id?>" rel="tooltip" data-original-title="Details"><i class="fa fa-eye"></i></a> &nbsp;
                                <a href="#partsModal" data-toggle="modal" data-target="#partsModal" data-id="<?=$part->parts_id?>" rel="tooltip" data-original-title="History"><i class="fa fa-history"></i></a> &nbsp;
                                <a href="#" data-id="<?=$part->parts_id?>" rel="tooltip" data-original-title="Archive"><i class="fa fa-archive"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="7"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No parts found!</div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </article>
        </div>
    </main>
</div>
<!-- Details Modal -->
<div class="modal fade" id="partsModal" tabindex="-1" role="dialog" aria-labelledby="partsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="partsModalLabel">ADD NEW PARTS</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalParts" method="post" action="<?=dashboard_url('parts/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create">
                    <input type="hidden" name="parts_id" id="parts_id" value="">
                    <div class="form-group">
                        <label for="name" class="col-xs-3 control-label">Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control unit-field" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="supplier" class="col-xs-3 control-label">Supplier</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control unit-field" id="supplier" name="supplier" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-xs-3 control-label">Price</label>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <b>Php</b>
                                </span>
                                <input type="number" class="form-control unit-field" id="price" name="price" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-xs-3 control-label"># of Stock</label>
                        <div class="col-xs-4">
                            <input type="number" class="form-control unit-field" id="stock" name="stock" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="purchase_date" class="col-xs-3 control-label">Date Purchase</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="purchase_date_dp">
                                <input type='text' class="form-control unit-field" id="purchase_date" name="purchase_date" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnModalPartsSave" onclick="$('#frmModalParts').submit()" data-loading-text="Saving..." class="btn btn-primary" autocomplete="off">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var parts_data = <?php echo $parts->num_rows() ? json_encode( $json_parts ) : '[]'; ?>;
</script>