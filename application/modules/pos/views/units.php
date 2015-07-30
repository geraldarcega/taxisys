<?php $pos_data = array(); ?>
    <main class="mainContainer" id="garrage_wrapper">
        <div class="Units"  >
            <div class="thisDay">
                <h4 class="allday monday">MONDAY</h4>
            </div><!-- thisDay -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
        </div><!-- units -->
        <div class="Units"  >
            <div class="thisDay">
                <h4 class="allday tuesday">TUESDAY</h4>
            </div><!-- thisDay -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
        </div><!-- units -->
        <div class="Units"  >
            <div class="thisDay">
                <h4 class="allday wednesday">Wednesday</h4>
            </div><!-- thisDay -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
        </div><!-- units -->
        <div class="Units"  >
            <div class="thisDay">
                <h4 class="allday thursday">THURSDAY</h4>
            </div><!-- thisDay -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
        </div><!-- units -->
        <div class="Units"  >
            <div class="thisDay">
                <h4 class="allday FRIDAY">friday</h4>
            </div><!-- thisDay -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="col col-md-3 ">
                        <?php if( $units['on_garrage']->num_rows() ) { ?>
                        <?php foreach ($units['on_garrage']->result() as $unit) { $pos_data[$unit->unit_id] = $unit; ?>
                        <div class="panel panel-yellow" id="taxi_<?=$unit->unit_id?>"> 
                            <a class="panel-side-link" href="#unitsModal" data-toggle="modal" data-target="#unitsModal" data-id="<?=$unit->unit_id?>" data-type="<?=UNIT_GARRAGE?>" data-backdrop="static">
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
                            <div class="panel-body panel-nametag"><?=$unit->first_name != '' && $unit->last_name != '' ? ucwords($unit->first_name.' '.$unit->last_name) : 'No Driver'?></div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
            </div><!-- row -->
        </div><!-- units -->
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
                <form class="form-horizontal" id="frmModalPOS" method="POST" action="<?=base_url('pos/ajax')?>">
                    <input type="hidden" name="action" id="action" value="">
                    <input type="hidden" name="unit_id" id="unit_id" value="">
                    <input type="hidden" name="old_driver" id="old_driver" value="">
                    <input type="hidden" name="old_status" id="old_status" value="">
                    <input type="hidden" name="coding_day" id="coding_day" value="">
                    <div class="form-group">
                        <label for="date" class="col-xs-3 control-label">Date</label>
                        <div class="col-xs-9">
                            <span id="date_now" style="padding-top: 7px;display: inline-block;"><?php echo date('M d, Y'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="driver" class="col-xs-3 control-label">Driver</label>
                        <div class="col-xs-9">
                            <span id="driver" style="padding-top: 7px;display: inline-block;"></span>
                            <select class="form-control" id="select_driver" name="select_driver" required>
                                <option value="">----</option>
                                <?php if( $drivers->num_rows() ) { ?>
                                <?php foreach ($drivers->result() as $driver) { ?>
                                <option value="<?=$driver->driver_id?>"><?=$driver->first_name?> <?=$driver->last_name?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group onduty-input">
                        <label for="rate_type" class="col-xs-3 control-label">Rate</label>
                        <div class="col-xs-9">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                    <input type="radio" name="rate_type" id="rate_type1" value="<?=BTYPE_REGULAR?>" autocomplete="off"> Regular
                                </label>
                                <label class="btn btn-primary">
                                    <input type="radio" name="rate_type" id="rate_type4" value="<?=BTYPE_HOLIDAY?>" autocomplete="off"> Holiday
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group onduty-input">
                        <label for="boundary" class="col-xs-3 control-label">Boundary</label>
                        <div class="col-xs-9">
                            <input type="number" class="form-control" id="boundary" name="boundary" placeholder="1500" maxlength="5" required>
                        </div>
                    </div>
                    <div class="form-group onduty-input">
                        <label for="drivers_fund" class="col-xs-3 control-label">Driver's fund</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="drivers_fund" name="drivers_fund" placeholder="50">
                        </div>
                    </div>
                    <div class="form-group onduty-input">
                        <label for="short" class="col-xs-3 control-label">Short</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" id="short" name="short">
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
                                <option value="<?=UNIT_DUTY?>">On-duty</option>
                                <option value="<?=UNIT_GARRAGE?>">On-garrage</option>
                                <option value="<?=UNIT_MAINTENANCE?>">On-maintenance</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#frmModalPOS').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var pos_json = <?=!empty($pos_data) ? json_encode($pos_data) : '[]'?>;
    var drivers_json = <?=$drivers->num_rows() ? json_encode($drivers->result()) : '[]'?>;
</script>