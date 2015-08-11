<?php if( $this->_method != 'login' ) { ?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=strtoupper($this->_class)?><?=isset($sub_nav) ? ' - '.strtoupper(str_replace('_', ' ', $sub_nav)) : ''?> (<?php echo date('F d, Y'); ?>)</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <?php 
    	$msg = $this->session->flashdata('msg'); 
    	if( is_array($msg) ){
	?>
    <!-- /message -->
    <div class="alert <?php echo $msg['class']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?=$msg['value']?>
    </div>
    <?php } ?>
    <?php if( $this->top_nav && $this->_class != 'pos' ) { ?>
    <div class="mainNav">
        <div class="row">
            <div class="col-xs-12 leftNavi">
                <nav class="navbar navbar-default ts-navbar-inner" style="margin-bottom: -1px; line-height: 47px;">
                    <?php /* if( $this->_class == 'pos' ) { ?>
                    <ul class="nav navbar-nav">
                        <li <?=@$sub_nav=='units' ? 'class="active"' : '';?>><a href="<?=pos_url()?>">UNITS</a></li>
                        <li <?=@$sub_nav=='drivers' ? 'class="active"' : '';?>><a href="<?=pos_url('drivers')?>">DRIVERS</a></li>
                    </ul>
                    <?php } */ ?>

                    <?php if( $this->_class == 'units' ) { ?>
                    <?php if( $this->_method == 'maintenance' ) { ?>
                    <ul class="nav navbar-nav">		
-                        <li <?=$this->uri->segment('4') == 'scheduled' ? 'class="active"' : ''?>><a href="<?=dashboard_url('units/maintenance/scheduled/'.$this->uri->segment('5'))?>">SCHEDULED</a></li>		
-                        <li <?=$this->uri->segment('4') == 'unscheduled' ? 'class="active"' : ''?>><a href="<?=dashboard_url('units/maintenance/unscheduled/'.$this->uri->segment('5'))?>">UNSCHEDULED</a></li>		
-                    </ul>
					<?php if ($this->uri->segment(4) == 'unscheduled' ) { ?>
                    <div class="navbar-right" style="margin-right:10px;">
                        <button type="button" class="btn btn-default navbar-btn ts-navbar-btn" data-toggle="modal" data-target="#maintenanceModal" data-backdrop="static"><i class="fa fa-plus-square"></i> Add maintenance</button>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                    <div class="navbar-left" style="margin-left:10px;">
                        <button type="button" class="btn btn-default navbar-btn ts-navbar-btn" data-toggle="modal" data-target="#unitsModal" data-backdrop="static"><i class="fa fa-plus-square"></i> Add new unit</button>
                    </div>
                    <div class="navbar-right" style="margin-right:10px;">
                        <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <?php if( $this->_class == 'drivers' ) { ?>
                    <div class="pull-right" style="margin-right:5px;">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#driversModal" data-backdrop="static"><i class="fa fa-plus-square"></i> NEW DRIVER</button>
                        <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                    <?php } ?>

                    <?php if( $this->_class == 'maintenance' ) { ?>
                    <?php if( @$sub_nav == 'scheduled' ) { ?>
                    <div class="pull-right" style="margin-right:5px;">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#driversModal" data-backdrop="static"><i class="fa fa-plus-square"></i> NEW SCHEDULE</button>
                        <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                    <?php } else { ?>
                    <div class="pull-right" style="margin-right:5px;">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#maintenanceModal" data-backdrop="static"><i class="fa fa-plus-square"></i> NEW ITEM</button>
                        <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <?php if( $this->_class == 'parts' ) { ?>
                    <div class="pull-right" style="margin-right:5px;">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#partsModal" data-backdrop="static"><i class="fa fa-plus"></i> NEW PARTS</button>
                    </div>
                    <?php } ?>

                    <?php if( $this->_class == 'administrator' && $sub_nav == 'garage' ) { ?>
                    <div class="pull-right" style="margin-right:5px;">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#garageModal" data-backdrop="static"><i class="fa fa-plus"></i> NEW GARRAGE</button>
                    </div>
                    <?php } ?>
                </nav>
            </div>
            <!-- <div class="col col-xs-3 chatDiv">
                <ul class="nav navbar-nav navbar-right chat-panel-header">
                    <li><span><i class="fa fa-comments"></i> CHAT</span></li>
                </ul> 
            </div> -->
        </div><!-- row -->
    </div><!-- mainNav -->
    <?php } ?>
<?php } ?>