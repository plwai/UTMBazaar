<html>
	<head>
		<title>Registration UTM BazaaR</title>
		<script type="text/javascript" src="<?php echo base_url();?>assets/\jquery/jquery-1.11.3.js" ></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets\javascript\validation/registration-validation.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/registration.css" />
		<link rel="stylesheet" href="<?php echo base_url("assets/bootstrap-3.3.5-dist\css/bootstrap.css"); ?>" />
		
	</head>
	<body>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>UTM BaZaar Registration</h4>
				</div>
				<div class="panel-body">
					<div id="validation-error"></div>
					<form method="post" action="register" id="registratio_form">

					<div class="form-group">
						<h5>First Name : </h5>
						<input type="text" name="sirname"  id="sirname" />
						<span id="usr_verify1" class="verify"></span><div class="text-danger" id="sirnametxt">
					</div>

					<div class="form-group">
						<h5>Last Name: </h5>
						<input type="text" name="name" id="name"    />
						<span id="usr_verify2" class="verify"></span><div class="text-danger" id="nametxt">
					</div>

					<div class="form-group">
						<h5>Email Address  : </h5>
						<input type="text" name="e-mail" id="e-mail"/>
						<span id="usr_verify3" class="verify"></span><div class="text-danger" id="e-mailtxt">
					</div>
					
					<div class="form-group">
						<h5>Confirma Email : </h5>
						<input type="text" name="email" id="email"/>
						<span id="usr_verify4" class="verify"></span><div class="text-danger" id="emailtxt">
					</div>

					<div class="form-group">
						<h5>Password : </h5>
						<input type="Password" name="password" id="password"  />
						<span id="usr_verify5" class="verify"></span><div class="text-danger" id="passwordtxt">
					</div>

					<div class="form-group">
						<h5>Type it again : </h5>
						<input type="Confirm Password" name="passconf" id="passconf"  /> 
						<span id="usr_verify6" class="verify"></span><div class="text-danger" id="passconftxt">
					</div>

					<div class="form-group">
						<input type="submit" id="submit" onclick="submit()" value="Submit" /><input type="submit" id="cancel" onclick="cancel()" value="cancel" />
						<div id="submittxt">
							
					</div>
					</form>


				</div>
			</div>
		</div>
	</div>
	</body>
</html>

