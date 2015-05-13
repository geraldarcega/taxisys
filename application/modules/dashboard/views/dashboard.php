<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">DASHBOARD</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <?=@$top_nav;?>
    <!-- /.row -->
<main class="mainContainer">
    <div class="row">
        <article class="col-xs-9">
            <div class="dash-border Units">
                <div class="col-xs-4 border-right">
                    <i class="dashboard-label">On-duty</i>
                    <div class="panel panel-green"> 
                     <div class="updateEditbtn">
                            <a href="#">UPDATE <i class="fa fa-angle-right"></i></a>
                        </div><!-- updateEditbtn -->                       
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 dash-units">
                                    <a href="#unitsModal" data-toggle="modal" data-target="#unitsModal"><i class="fa fa-taxi"></i> <div class="huge">ABC 123</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body panel-nametag">Jason Bourne</div>                        
                    </div>
                    <div class="panel panel-green">
                    <div class="updateEditbtn">
                            <a href="#">UPDATE <i class="fa fa-angle-right"></i></a>
                        </div><!-- updateEditbtn -->    
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 dash-units">
                                    <a href="#unitsModal" data-toggle="modal" data-target="#unitsModal"><i class="fa fa-taxi"></i> <div class="huge">ABC 123</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body panel-nametag">Jason Bourne</div>                        
                    </div>
                    <div class="panel panel-green">
                    <div class="updateEditbtn">
                            <a href="#">UPDATE <i class="fa fa-angle-right"></i></a>
                        </div><!-- updateEditbtn -->       
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 dash-units">
                                    <a href="#unitsModal" data-toggle="modal" data-target="#unitsModal"><i class="fa fa-taxi"></i> <div class="huge">ABC 123</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body panel-nametag">Jason Bourne</div>                        
                    </div>
                </div>
                <div class="col-xs-4 border-right">
                    <i class="dashboard-label">On-garrage</i>
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 dash-units">
                                    <a href="#unitsModal" data-toggle="modal" data-target="#unitsModal"><i class="fa fa-taxi"></i> <div class="huge">ABC 123</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body panel-nametag">Jason Bourne</div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <i class="dashboard-label">On-maintenance</i>
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12 dash-units">
                                    <a href="#unitsModal" data-toggle="modal" data-target="#unitsModal"><i class="fa fa-taxi"></i> <div class="huge">ABC 123</div></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body panel-nametag">Jason Bourne</div>
                    </div>
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
                            <span id="date"></span>
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>