<div class="mainNav">
    <div class="row">
        <div class="col-xs-12 leftNavi">
            <nav class="navbar navbar-default ts-navbar-inner" style="margin-bottom: -1px; line-height: 47px;">
                <?php if( $nav == 'pos' ) { ?>
                <ul class="nav navbar-nav">
                    <li <?=@$sub_nav=='units' ? 'class="active"' : '';?>><a href="<?=pos_url()?>">UNITS</a></li>
                    <li <?=@$sub_nav=='drivers' ? 'class="active"' : '';?>><a href="<?=pos_url('drivers')?>">DRIVERS</a></li>
                </ul>
                <?php } ?>

                <?php if( $nav == 'units' ) { ?>
                <div class="navbar-left" style="margin-left:10px;">
                    <button type="button" class="btn btn-default navbar-btn ts-navbar-btn" data-toggle="modal" data-target="#unitsModal"><i class="fa fa-plus-square"></i> Add new unit</button>
                </div>
                <div class="navbar-right" style="margin-right:10px;">
                    <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <?php } ?>

                <?php if( $nav == 'drivers' ) { ?>
                <div class="pull-right" style="margin-right:5px;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#driversModal"><i class="fa fa-plus-square"></i> NEW DRIVER</button>
                    <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <?php } ?>

                <?php if( $nav == 'maintenance' ) { ?>
                <?php if( $sub_nav == 'scheduled' ) { ?>
                <div class="pull-right" style="margin-right:5px;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#driversModal"><i class="fa fa-plus-square"></i> NEW SCHEDULE</button>
                    <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <?php } if( $sub_nav == 'items' ) { ?>
                <div class="pull-right" style="margin-right:5px;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#maintenanceModal"><i class="fa fa-plus-square"></i> NEW ITEM</button>
                    <button type="button" class="btn btn-default" id="filter" data-container="body" data-toggle="popover" data-placement="bottom"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <?php } ?>
                <?php } ?>

                <?php if( $nav == 'administrator' && $sub_nav == 'garrage' ) { ?>
                <div class="pull-right" style="margin-right:5px;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#garrageModal"><i class="fa fa-plus"></i> NEW GARRAGE</button>
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