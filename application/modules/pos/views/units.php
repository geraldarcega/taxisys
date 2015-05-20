<div id="page-wrapper">
    <?=@$page_header;?>
    <!-- /.row -->
    <?=@$top_nav;?>
    <!-- /.row -->
    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-9">
                <div class="dash-border Units">
                    <div class="col-xs-4 border-right">
                        <i class="dashboard-label">On-duty</i>
                        <?php if( $units['on_duty']->num_rows() ) { ?>
                        <?php foreach ($units['on_duty']->result() as $unit) { ?>
                        <div class="panel panel-green"> 
                           <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="duty">
                                <div class="updateEditbtn">
                                    UPDATE<i class="fa fa-angle-right"></i>
                                </div><!-- updateEditbtn -->
                            </a>
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 dash-units">
                                        <i class="fa fa-taxi"></i> <div class="huge"><?=strtoupper($unit->plate_number)?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body panel-nametag"><?=ucwords($unit->fname.' '.$unit->lname)?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-xs-4 border-right">
                        <i class="dashboard-label">On-garrage</i>
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { ?>
                        <div class="panel panel-yellow"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="garrage">
                                <div class="updateEditbtn">
                                    UPDATE<i class="fa fa-angle-right"></i>
                                </div><!-- updateEditbtn -->
                            </a>
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 dash-units">
                                        <i class="fa fa-taxi"></i> <div class="huge"><?=strtoupper($unit->plate_number)?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body panel-nametag"><?=ucwords($unit->fname.' '.$unit->lname)?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col-xs-4 border-right">
                        <i class="dashboard-label">On-maintenance</i>
                        <?php if( $units['on_maintenance']->num_rows() ) { ?>
                        <?php foreach ($units['on_maintenance']->result() as $unit) { ?>
                        <div class="panel panel-red">
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="maintenance">
                                <div class="updateEditbtn">
                                    UPDATE<i class="fa fa-angle-right"></i>
                                </div><!-- updateEditbtn -->
                            </a>
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12 dash-units">
                                        <i class="fa fa-taxi"></i> <div class="huge"><?=strtoupper($unit->plate_number)?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body panel-nametag"><?=ucwords($unit->fname.' '.$unit->lname)?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </article>
            <aside class="col-xs-3">
                <?=@$chat;?>
            </aside>
        </div>
    </main>
</div>
<!-- Modal -->
<div class="modal fade" id="unitsModal" tabindex="-1" role="dialog" aria-labelledby="unitsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="unitsModalLabel">UNIT - ABC 123</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="date" class="col-xs-3 control-label">Date</label>
                        <div class="col-xs-9">
                            <?php echo date('M d, Y'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="driver" class="col-xs-3 control-label">Driver</label>
                        <div class="col-xs-9">
                            <span id="driver"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="boundary" class="col-xs-3 control-label">Boundary</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="boundary" placeholder="1500">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="drivers_fund" class="col-xs-3 control-label">Driver's fund</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="drivers_fund" placeholder="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="short" class="col-xs-3 control-label">Short</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="short">
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
                                <option value="">----</option>
                                <option value="1">On-duty</option>
                                <option value="2">On-garrage</option>
                                <option value="3">On-maintenance</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var on_duty         = <?=$units['on_duty']->num_rows() ? json_encode($units['on_duty']->result()) : '[]'?>;
    var on_garrage      = <?=$units['on_garrage']->num_rows() ? json_encode($units['on_garrage']->result()) : '[]'?>;
    var on_maintenance  = <?=$units['on_maintenance']->num_rows() ? json_encode($units['on_maintenance']->result()) : '[]'?>;
</script>