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
                <!-- <div class="dash-border Units"> -->
                    <table id="tbl_all_units" class="table">
                        <thead style="background-color:#fff;">
                            <th>#</th>
                            <th>Plate #</th>
                            <th>Year Model</th>
                            <th>Coding Day</th>
                            <th>Franchise Until</th>
                            <th>Renew By</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <tr id="tbl_loading" style="display:none;">
                                <td colspan="7" align="center"><h3><i class="fa fa-cog fa-spin"></i> Loading...</h3></td>
                            </tr>
                            <?php if( $units->num_rows() ) { $i = 0; ?>
                            <?php foreach ($units->result() as $unit) { $i++; $json_units[$unit->unit_id] = $unit; ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=strtoupper($unit->plate_number)?></td>
                                <td><?=$unit->year_model?></td>
                                <td><?=$unit->coding_day?></td>
                                <td><?=dateFormat($unit->franchise_until, 'M d, Y')?></td>
                                <td><?=dateFormat($unit->renew_by, 'M d, Y')?></td>
                                <td><a href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" ><i class="fa fa-eye"></i></a></td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td colspan="7"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No units found!</div></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <!-- </div> -->
            </article>
            <aside class="col-xs-3">
                <?=@$chat;?>
            </aside>
        </div>
    </main>
</div>
<!-- Modal -->
<div class="modal fade" id="unitsModal" tabindex="-1" role="dialog" aria-labelledby="unitsModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="unitsModalLabel">ADD NEW UNIT</h4>
            </div>
            <div class="modal-body">
                <div id="failed_msg" class="alert alert-danger" role="alert" style="display:none;">
                    <span></span>
                </div>
                <form class="form-horizontal" id="frmModalUnits" method="post" action="<?=dashboard_url('units/ajax')?>">
                    <input type="hidden" name="action" id="action" value="create">
                    <input type="hidden" name="unit_id" id="unit_id" value="">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="plate_number" class="col-xs-4 control-label">Plate #</label>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control unit-field" id="plate_number1" name="plate_number1" maxlength="3" required placeholder="AAA">
                                </div>
                                <div class="col-xs-4">
                                    <input type="text" class="form-control unit-field" id="plate_number2" name="plate_number2" maxlength="4" required placeholder="123">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="year_model" class="col-xs-4 control-label">Year Model</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="year_model_dp">
                                        <input type="text" class="form-control unit-field" id="year_model" name="year_model" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Coding Day</label>
                                <div class="col-xs-8">
                                    <select id="coding_day" name="coding_day" class="form-control unit-field" required>
                                        <option value="">----</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Releasing Date 1</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="releasing_date1_dp">
                                        <input type='text' class="form-control unit-field" id="releasing_date1" name="releasing_date1" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Releasing Date 2</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="releasing_date2_dp">
                                        <input type='text' class="form-control unit-field" id="releasing_date2" name="releasing_date2" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Franchise Until</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="franchise_until_dp">
                                        <input type='text' class="form-control unit-field" id="franchise_until" name="franchise_until" required/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Renew By</label>
                                <div class="col-xs-8">
                                    <div class="input-group date" id="renew_by_dp">
                                        <input type='text' class="form-control unit-field" id="renew_by" name="renew_by" required />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Regular Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="reg_rate" name="reg_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Sunday Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="sunday_rate" name="sunday_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Holiday Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="holiday_rate" name="holiday_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Coding Rate</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="coding_rate" name="coding_rate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Overhead Fund</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="overhead_fund" name="overhead_fund" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Docs Fund</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="docs_fund" name="docs_fund" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="reg_rate" class="col-xs-4 control-label">Replacement Fund</label>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <b>Php</b>
                                        </span>
                                        <input type="number" class="form-control unit-field" id="replacement_fund" name="replacement_fund" required>
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript">
    var units_data = <?php echo $units->num_rows() ? json_encode( $json_units ) : '[]'; ?>;
</script>