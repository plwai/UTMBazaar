<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>

</head>
<body>
			<p><?php echo $message; ?></p>
      <?php echo form_open('account/reset_password/resend'); ?>
			<?php echo form_close(); ?>
</body>
</html>
