

<!DOCTYPE html>

<!-- Jquery Validation Plugin version 1.13.0-->
<script src="<?php echo base_url(); ?>assets/jquery-validation-1.13.1/dist/jquery.validate.js"></script>

<body>

	<div class="container">
		<br>
		<br>
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4 login-form">
				<?php echo form_open('account/login'); ?>

					<h3>Sign In</h2>
					<hr>

					<div class="form-group">
						<h4>Email</h4>
						<input type="email" name="email" class="form-control" id="email">
					</div>

					<div class="form-group">
						<h4>Password</h4>
						<input type="password" name="password" class="form-control" id="password">
					</div>

					<br>

					<button type="submit" class="btn btn-default">Login</button>
					<br>
					<br>
					<br>

				<?php echo validation_errors(); ?>
				<?php echo form_close(); ?>
			</div>

			<div class="col-sm-4">
			</div>
		</div>
	</div>
</body>
