<html>
	<head>
		<title>Sign Up</title>
		<style>
			.error-message{color:red;}
		</style>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-2.1.4.min.js" ></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/registration.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/style.css" />
		
	</head>
	<body>
		<?php //echo form_open('Account/register', array('id'=>'registratio_form')); ?>
		<div id="validation-error"></div>
		<form method="post" action="register" id="registratio_form">
		<h5>Sir name is: </h5>
		<input type="text" name="sirname"  id="sirname"    value="<?php //echo set_value('sirname'); ?>"   /><?php //echo form_error('sirname'); ?>
		<span id="usr_verify1" class="verify"></span><div id="sirnametxt"></div>
		
		<h5>My name is: </h5>
		<input type="text" name="name" id="name"  value="<?php //echo set_value('name'); ?>"  /><?php //echo form_error('name'); ?>
		<span id="usr_verify2" class="verify"></span><div id="nametxt"></div>
		
		<h5>My e-mail address is : </h5>
		<input type="text" name="e-mail" id="e-mail"  value="<?php //echo set_value('e-mail'); ?>"  /><?php //echo form_error('e-mail'); ?>
		<span id="usr_verify3" class="verify"></span><div id="e-mailtxt"></div>
		
		<h5>Type it again : </h5><div><?php //echo $email_states; ?></div>
		<input type="text" name="email" id="email"  value="<?php //echo set_value('email'); ?>"  /><?php //echo form_error('email'); ?><?php //echo $email_states; ?>
		<span id="usr_verify4" class="verify"></span><div id="emailtxt"></div>
		
		<h5>Enter a new password : </h5>
		<input type="password" name="password" id="password" value="<?php //echo set_value('password'); ?>"  /><?php //echo form_error('password'); ?>
		<span id="usr_verify5" class="verify"></span><div id="passwordtxt"></div>
		
		<h5>Type it again : </h5>
		<input type="password" name="passconf" id="passconf"  value="<?php //echo set_value('passconf'); ?>" /><?php //echo form_error('passconf'); ?> 
		<span id="usr_verify6" class="verify"></span><div id="passconftxt"></div>
		
		<input type="submit" id="submit" onclick="submit()" value="Submit" /><input type="submit" id="cancel" onclick="cancel()" value="cancel" /><div id="submittxt"></div><?php   if(validation_errors())
		{
			//echo "Please fill in all the information";
		}; ?>

		</form>


	</body>
</html>

