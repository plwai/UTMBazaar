<script type="text/javascript" src="<?php echo base_url();?>assets\javascript\validation/registration-validation.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/registration.css" />

<body>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>UTM BaZaar User Information</h4>
						</div>
						<div class="panel-body">
						
							<?php foreach ($single_user as $user): ?>
							<div id="validation-error"></div>
							<form method="post" action="<?php echo base_url() . "account/update_user"?>" id="registratio_form">
					
					<div class="form-group">
						<h5>First Name : </h5>
						<input type="text" name="surname"  id="surname" value="<?php echo $user->surname;?>">
						<div class="text-danger" id="surnametxt">
					</div>

					<div class="form-group">
						<h5>Last Name: </h5>
						<input type="text" name="name" id="name" value="<?php echo $user->name;?>"> 	
						<div class="text-danger" id="nametxt">
					</div>

					<div class="form-group">
						<h5>Email Address  : </h5>
						<input type="text" name="email" id="email" value="<?php echo $user->email;?>">
						<div class="text-danger" id="e-mailtxt">
					</div>

								<div class="form-group">
									<input type="submit" id="submit" onclick="submit()" value="Update" /><input type="submit" id="cancel" onclick="cancel()" value="Cancel" />
									<div id="submittxt">
								</div>

							</form>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

