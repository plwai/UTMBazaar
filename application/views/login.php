

<!DOCTYPE html>

<!-- Jquery Validation Plugin version 1.13.0-->
<script type="text/javascript" src="<?php echo base_url();?>assets/\jquery/jquery-1.11.3.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>assets\javascript\validation/login-validation.js"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/bootstrap-3.3.5-dist\css/bootstrap.css"); ?>" />

<body>

	<div class="container">
		<br>
		<br>
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4 login-form">
				<form action='post'>
                
					<h3>Sign In</h2>
					<hr>

					<div class="form-group">
						<h4>Email</h4>
						<input type="email" name="email" class="form-control" id="email">
						<p id ="email" ></p>
						<p id ="email2" ></p>
					</div>

					<div class="form-group">
						<h4>Password</h4>
						<input type="password" name="password" class="form-control" id="password">
						<p id="password"></p>
					</div>

					<br>
                    <p id="respond"></p>
					<button id="submit" type="button" class="btn btn-default">Login</button>
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
