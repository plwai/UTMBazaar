<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>

</head>
<body>
      <?php echo form_open('account/change_password'); ?>
        New Password: <input type="text" name="pass">
        Retype Password: <input type="text" name="pass_re">

        <input type='submit' name="change_pass" value="Submit">
			<?php echo form_close(); ?>
</body>
</html>
