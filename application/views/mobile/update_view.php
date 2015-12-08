<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UTM BazaaR</title>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link href="<?php echo base_url("bootstrap/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<div class="row">
	
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Info Update</h4>
			</div>
			<div class="panel-body">
				<?php foreach ($single_user as $user): ?>
							
						<form method="post" action="<?php echo base_url() . "account/update_user"?>" >
				

				<div class="form-group">
					<label for="name">First Name</label>
					<input class="form-control" name="sirname" placeholder="Your First Name" type="text" value="<?php echo $user->surname; ?>" />
					<span class="text-danger"><?php echo form_error('sirname'); ?></span>
				</div>

				<div class="form-group">
					<label for="name">Last Name</label>
					<input class="form-control" name="name" placeholder="Last Name" type="text"  value="<?php echo $user->name; ?>" />
					<span class="text-danger"><?php echo form_error('name'); ?></span>
				</div>
				
				<div class="form-group">
					<label for="email">Email ID</label>
					<input class="form-control" name="email" placeholder="Email-ID" type="text" value="<?php echo $user->email; ?>" />
					<span class="text-danger"><?php echo form_error('email'); ?></span>
				</div>

				

				<div class="form-group">
					<button name="submit" type="submit" class="btn btn-default" onclick="account.php">Update</button>
					<button name="cancel" type="reset" class="btn btn-default">Cancel</button>
				</div>
				<?php echo form_close(); ?>
				<?php endforeach; ?>
				<?php echo $this->session->flashdata('msg'); ?>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-1.11.3.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</body>
</html>