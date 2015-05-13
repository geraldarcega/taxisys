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
                <h4 class="modal-title" id="unitsModalLabel">ADD NEW UNIT</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="plate_number" class="col-xs-4 control-label">Plate #</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="plate_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year_model" class="col-xs-4 control-label">Year Model</label>
                        <div class="col-xs-3">
                            <div class="input-group date' id='year_model">
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Regular Rate</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="reg_rate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Holiday Rate</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="reg_rate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Coding Rate</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="reg_rate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Coding Day</label>
                        <div class="col-xs-4">
                            <select id="coding_day" name="coding_day" class="form-control">
                                <option value="">----</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                                <option value="7">Sunday</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Releasing Date 1</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="releasing_date1">
                                <input type='text' class="form-control" name="releasing_date1" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Releasing Date 2</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="releasing_date2">
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Franchise Until</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="franchise_until">
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Renew By</label>
                        <div class="col-xs-5">
                            <div class="input-group date">
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Overhead Fund</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="reg_rate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Docs Fund</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="reg_rate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Replacement Fund</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="reg_rate">
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