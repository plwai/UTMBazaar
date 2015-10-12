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
							<!-- Fetching Names Of All Users From Database -->
							<ol>
					<?php foreach ($utm_users as $user): ?>
					<li><a href="<?php echo base_url() . "index.php/update_ctrl/show_user_id/" . $user->pkid; ?>"><?php echo $user->name; ?></a></li>
					<?php endforeach; ?>
							</ol>
						</div>
				<div id="detail">
				<!-- Fetching All Details of Selected User From Database And Showing In a Form -->
					<?php foreach ($single_user as $user): ?>
					<p>Edit Detail & Click Update Button</p>
					<form method="post" action="<?php echo base_url() . "index.php/update_ctrl/update_user_id1"?>">
						<label id="hide">Id :</label>
							<input type="text" id="hide" name="did" value="<?php echo $user->pkid; ?>">
						
						<label>Name :</label>
							<input type="text" name="name" value="<?php echo $user->name; ?>">
						
						<label>Email :</label>
							<input type="text" name="email" value="<?php echo $user->email; ?>">
						
						<input type="submit" id="submit" name="submit" value="Update">
						
					</form>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</body>
</html>