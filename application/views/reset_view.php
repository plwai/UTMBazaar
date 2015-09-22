<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>

</head>
<body>
			<?php echo form_open('account/reset_password'); ?>

				Email Address: <input type="text" name="email">
			  <br>
        <input type='submit' name="login" value="Reset">


			<?php echo validation_errors(); ?>
			<?php echo $this->session->flashdata('errmsg'); ?>


			<?php echo form_close(); ?>
</body>
</html>
