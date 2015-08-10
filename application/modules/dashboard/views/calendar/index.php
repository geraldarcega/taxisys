    <main class="mainContainer">
        <div class="row">
            <article class="col-xs-10">
                <div id="calendar">
                
                </div>
            </article>
            <article class="col-xs-2">
                <div id="calendar-filter">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-list-ul fa-fw"></i> Filters
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                            <ul class="nav nav-pills nav-stacked">
                            	<li>
                            		<a href="#" class="list-group-item label label-default"><i class="fa fa-arrow-circle-right fa-fw"></i> All</a>
                            	</li>
								<li role="presentation">
									<a href="#" class="list-group-item label label-danger">Maintenance</a>
								</li>
								<li role="presentation">
									<a href="#" class="list-group-item label label-success">Docs</a>
								</li>
								<li role="presentation">
									<a href="#" class="list-group-item label" style="background-color: #6227C7;">Resealing 1</a>
								</li>
								<li role="presentation">
									<a href="#" class="list-group-item label" style="background-color: #C1DE17;">Resealing 2</a>
								</li>
								<li role="presentation">
									<a href="#" class="list-group-item label label-info">Renewal</a>
								</li>
								<li role="presentation">
									<a href="#" class="list-group-item label label-warning">Franchise</a>
								</li>
							</ul>
							<hr>
							<button class="btn btn-success btn-block"><i class="fa fa-plus fa-fw"></i> Add schedule</button>
                        </div>
                        <!-- /.panel-body -->
                    </div>
            	</div>
            </article>
        </div>
    </main>
    <!-- /.row -->
</div>
<!-- Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="calendarModalLabel">UNIT - ABC 123</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="frmModalCalendar" method="POST" action="<?=base_url('pos/ajax')?>">
					<input type="hidden" name="action" id="action" value="">
					<input type="hidden" name="unit_id" id="unit_id" value="">
					<div class="form-group">
						<label for="reg_rate" class="col-xs-3 control-label">Date</label>
						<div class="col-xs-6">
							<div class="input-group" id="date_dp">
								<input type='text' class="form-control unit-field" id="date" name="date" required />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="remarks" class="col-xs-3 control-label">Notes</label>
						<div class="col-xs-9">
							<textarea class="form-control" name="notes" id="notes" rows="7" style="resize:none;"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="$('#frmModalCalendar').submit();">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>