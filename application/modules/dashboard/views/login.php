<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-taxi"></i> Taxi System - Log in</h3>
				</div>
				<div class="panel-body">
					<div class="alert alert-danger" role="alert" style="display:none;">
						<strong><i class="fa fa-exclamation-triangle"></i> Access denied!</strong> Please try again.
					</div>
					<form role="form" id="frmLogin">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password">
							</div>
							<button id="btnLogin" data-loading-text="<i class='fa fa-cog fa-spin'></i> Loading..." autocomplete="off" type="button" class="btn btn-lg btn-success btn-block" onclick="login();">Login</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>