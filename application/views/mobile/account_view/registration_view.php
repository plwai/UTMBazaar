<script type="text/javascript" src="<?php echo base_url();?>assets\javascript\validation/registration-validation.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/registration.css" />

<body id="formpage" >
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-xs-offset-1 col-xs-10">
					<div >
						<div class="panel-heading">
							<h4>UTM BaZaar Registration</h4>
						</div>
						<div class="panel-body">
							<div id="validation-error"></div>
							<form method="post" action="register" id="registratio_form">
					<div class="form-group">
						<h5><b>First Name : </h5>
						<input type="text" name="sirname"  id="sirname" class="form-control"/>
						<div class="text-danger" id="sirnametxt">
					</div>

					<div class="form-group">
						<h5><b>Last Name: </h5>
						<input type="text" name="name" id="name"   class="form-control" />
						<div class="text-danger" id="nametxt">
					</div>

					<div class="form-group">
						<h5><b>Email Address  : </h5>
						<input type="text" name="e-mail" id="e-mail" class="form-control"/>
						<div class="text-danger" id="e-mailtxt">
					</div>

					<div class="form-group">
						<h5><b>Confirm Email : </h5>
						<input type="text" name="email" id="email" class="form-control"/>
						<div class="text-danger" id="emailtxt">
					</div>

					<div class="form-group">
						<h5><b>Password : </h5>
						<input type="Password" name="password" id="password" class="form-control"  />
						<div class="text-danger" id="passwordtxt">
					</div>

								<div class="form-group">
									<h5><b>Type it again : </h5>
									<input type="password" name="passconf" id="passconf"  class="form-control" />
									<span id="usr_verify6" class="verify"></span><div class="text-danger" id="passconftxt">
								</div>

								<div class="form-group">
									<hr>
									<input type="submit" id="submit" onclick="submit()" value="Submit" class="form-control" />
									
									<input type="submit" id="cancel" onclick="cancel()" value="cancel"  class="form-control"/>
									<div id="submittxt">
								</div>

							</form>


						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
