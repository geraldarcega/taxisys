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
                <!-- <div style="text-align: center;margin-bottom: 16px;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#driversModal">ADD NEW DRIVER</button>
                </div> -->
                <table class="table table-hover tablesorter" id="tbl_drivers">
                    <thead style="border-bottom: 3px solid #BDBDBD;background-color: #fff;">
                        <tr>
                            <th>#</th>
                            <th>Current Unit</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>On-duty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if( $drivers->num_rows() > 0 ) {  $cnt = 0; ?>
                        <?php foreach ($drivers->result() as $driver) { $cnt++; $json_drivers[$driver->driver_id] = $driver; ?>
                        <tr>
                            <td><?=$cnt?></td>
                            <td><?=strtoupper($driver->plate_number)?></td>
                            <td><?=ucwords($driver->fname)?></td>
                            <td><?=ucwords($driver->lname)?></td>
                            <td><?=driverStatus($driver->status)?></td>
                            <td><a href="#driversModal" data-toggle="modal" data-target="#driversModal" data-id="<?=$driver->driver_id?>" ><i class="fa fa-eye"></i></a></td>
                        </tr>                        
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="5"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No records found!</div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                            <select id="unit" name="unit" class="form-control driver-field" required>
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
                        <label for="fname" class="col-xs-4 control-label">Full Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control driver-field" id="fname" name="fname" placeholder="First name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mname" class="col-xs-4 control-label">&nbsp;</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control driver-field" id="mname" name="mname" placeholder="Middle name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lname" class="col-xs-4 control-label">&nbsp;</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control driver-field" id="lname" name="lname" placeholder="Last name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-xs-4 control-label">Birth Date</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="dob_dp">
                                <input type="text" class="form-control driver-field" id="dob" name="dob" required/>
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
                            <input type="text" class="form-control driver-field" id="sss" name="sss" required>
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