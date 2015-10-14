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
			
				
				
		<li><a href="<?php echo base_url() . "account/show_user/" . $utm_user->pkid; ?>"><?php echo $student->student_name; ?></a></li>

	
			</div>
		<div id="detail">

		<?php foreach ($single_user as $user): ?>
		
		?>
			<p>Edit Detail & Click Update Button</p>
				<form method="post" action="<?php echo base_url() . "account/update_user"?>">
					<label id="hide">Id :</label>
						<input type="text" id="hide" name="did" value="<?php echo $user->pkid; ?>">
					<label>Name :</label>
						<input type="text" name="dname" value="<?php echo $user->name; ?>">
					<label>Email :</label>
						<input type="text" name="demail" value="<?php echo $user->email; ?>">

					<input type="submit" id="submit" name="dsubmit" value="Update">
				</form>
		<?php endforeach; ?>
	</div>
		</div>
	</div>
</body>
</html>