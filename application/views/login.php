

<!DOCTYPE html>

<!-- Jquery Validation Plugin version 1.13.0-->
<script type="text/javascript" src="<?php echo base_url();?>assets\javascript\validation/login-validation.js"></script>


<body>

	<div class="container">
		<br>
		<br>
		<div class="row">
			<div class="col-sm-offset-4 col-sm-4 login-form">
				<form method='post'>

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
            <a href=<?php echo base_url("account/reset_password")?>>Forget password?</a>
					</div>

					<br>
                    <p id="respond"></p>
          <div class="form-group">
					<button id="submit" type="submit" class="btn btn-default">Login</button>
          </div>
					<br>
					<br>
					<br>

				</form>
			</div>

			<div class="col-sm-4">
			</div>
		</div>
	</div>
</body>
