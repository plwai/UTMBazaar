<html>
	<head>
		<title>UTM BazaaR</title>
			<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/update.css" ?>">
	</head>
		<body>
			<div id="container">
				<div id="wrapper">
					<h1>UTM BazaaR</h1><hr/>
						<div id="menu">
							<p>Click On Menu</p>
							
							
					<?php echo form_open('account/update'); ?>
					<p><label for="name">Name</label>
						<input type="text" name="name" id="name" />
					</p>
					<p><label for="email">Email</label>
						<input type="text" name="email" id="email" />
					</p>

					<p><input type="submit" value="Save" /></p>

					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</body>
</html>