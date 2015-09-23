<html>
<head>
<title>Sign Up</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('Registration/register'); ?>

<h5>My name is: </h5>
<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="50" />

<h5>My e-mail address is : </h5>
<input type="text" name="e-mail" value="<?php echo set_value('e-mail'); ?>" size="50" />

<h5>Type it again : </h5>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" size="50" />

<h5>Enter a new password : </h5>
<input type="text" name="password" value="<?php echo set_value('password'); ?>" size="50" />

<h5>Type it again : </h5>
<input type="text" name="passconf" value="<?php echo set_value('passconf'); ?>" size="50" />



<input type="submit" value="Submit" />

</form>

</body>
</html>