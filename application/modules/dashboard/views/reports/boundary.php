    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-12">
                <div class="dash-border Units">
                    <table class="table">
                        <thead>
                            <th colspan="2">&nbsp</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th></th>
                        </thead>
                        <thead style="border-bottom: 3px solid #BDBDBD;background-color: #fff;">
                            <th>#</th>
                            <th>PLATE #</th>
                            <th>SUN</th>
                            <th>MON</th>
                            <th>TUE</th>
                            <th>WED</th>
                            <th>THUR</th>
                            <th>FRI</th>
                            <th>SAT</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php if( count($boundary) > 0 ) { ?>

                            <?php } else { ?>
                            <tr>
                                <td colspan="10"><div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> No records found!</div></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </article>
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
                <form class="form-horizontal" id="frmModalUnits" method="post" action="">
                    <div class="form-group">
                        <label for="plate_number" class="col-xs-4 control-label">Plate #</label>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" id="plate_number" name="plate_number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="year_model" class="col-xs-4 control-label">Year Model</label>
                        <div class="col-xs-3">
                            <div class="input-group date" id="year_model_dp">
                                <input type="text" class="form-control" id="year_model" name="year_model" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Regular Rate</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="reg_rate" name="reg_rate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Holiday Rate</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="holiday_rate" name="holiday_rate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Coding Rate</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" id="coding_rate" name="coding_rate" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Coding Day</label>
                        <div class="col-xs-4">
                            <select id="coding_day" name="coding_day" class="form-control" required>
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
                        <label for="reg_rate" class="col-xs-4 control-label">resealing Date 1</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="resealing_date1_dp">
                                <input type='text' class="form-control" id="resealing_date1" name="resealing_date1" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">resealing Date 2</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="resealing_date2_dp">
                                <input type='text' class="form-control" id="resealing_date2" name="resealing_date2" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Franchise Until</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="franchise_until_dp">
                                <input type='text' class="form-control" id="franchise_until" name="franchise_until" required/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Renew By</label>
                        <div class="col-xs-5">
                            <div class="input-group date" id="renew_by_dp">
                                <input type='text' class="form-control" id="renew_by" name="renew_by" required />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Overhead Fund</label>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <b>Php</b>
                                </span>
                                <input type="text" class="form-control" id="overhead_fund" name="overhead_fund" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Docs Fund</label>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <b>Php</b>
                                </span>
                                <input type="text" class="form-control" id="docs_fund" name="docs_fund" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_rate" class="col-xs-4 control-label">Replacement Fund</label>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <b>Php</b>
                                </span>
                                <input type="text" class="form-control" id="replacement_fund" name="replacement_fund" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>