<html>
	<head>
		<title>Sign Up</title>
		<style>
			.error-message{color:red;}
		</style>
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
					<h4>UTM BaZaar Registration Form</h4>
				</div>
				<div class="panel-body">
					<?php //echo form_open('Account/register', array('id'=>'registratio_form')); ?>
					<div id="validation-error"></div>
					<form method="post" action="register" id="registratio_form">

					<div class="form-group">
						<h5>Sir name is: </h5>
						<input type="text" name="sirname"  id="sirname"    value="<?php //echo set_value('sirname'); ?>"   /><?php //echo form_error('sirname'); ?>
						<span id="usr_verify1" class="verify"></span><div class="text-danger" id="sirnametxt"></div>
					</div>

					<div class="form-group">
						<h5>My name is: </h5>
						<input type="text" name="name" id="name"  value="<?php //echo set_value('name'); ?>"  /><?php //echo form_error('name'); ?>
						<span id="usr_verify2" class="verify"></span><div class="text-danger" id="nametxt"></div>
					</div>

					<div class="form-group">
						<h5>My e-mail address is : </h5>
						<input type="text" name="e-mail" id="e-mail"  value="<?php //echo set_value('e-mail'); ?>"  /><?php //echo form_error('e-mail'); ?>
						<span id="usr_verify3" class="verify"></span><div class="text-danger" id="e-mailtxt"></div>
					</div>
					
					<div class="form-group">
						<h5>Type it again : </h5><div><?php //echo $email_states; ?></div>
						<input type="text" name="email" id="email"  value="<?php //echo set_value('email'); ?>"  /><?php //echo form_error('email'); ?><?php //echo $email_states; ?>
						<span id="usr_verify4" class="verify"></span><div class="text-danger" id="emailtxt"></div>
					</div>

					<div class="form-group">
						<h5>Enter a new password : </h5>
						<input type="password" name="password" id="password" value="<?php //echo set_value('password'); ?>"  /><?php //echo form_error('password'); ?>
						<span id="usr_verify5" class="verify"></span><div class="text-danger" id="passwordtxt"></div>
					</div>

					<div class="form-group">
						<h5>Type it again : </h5>
						<input type="password" name="passconf" id="passconf"  value="<?php //echo set_value('passconf'); ?>" /><?php //echo form_error('passconf'); ?> 
						<span id="usr_verify6" class="verify"></span><div class="text-danger" id="passconftxt"></div>
					</div>

					<div class="form-group">
						<input type="submit" id="submit" onclick="submit()" value="Submit" /><input type="submit" id="cancel" onclick="cancel()" value="cancel" /><div id="submittxt"></div><?php   if(validation_errors())
						{
							//echo "Please fill in all the information";
						}; ?>
					</div>
					</form>


				</div>
			</div>
		</div>
	</div>










		

		
		
		
		
		
		
		
		
		


		

	</body>
</html>

