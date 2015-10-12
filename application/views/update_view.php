<html>
	<head>
		<title>Update Data In Database Using CodeIgniter</title>
			<link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url(). "css/update.css" ?>">
	</head>
		<body>
			<div id="container">
				<div id="wrapper">
					<h1>Update Data In Database Using CodeIgniter </h1><hr/>
						<div id="menu">
							<p>Click On Menu</p>
							<!-- Fetching Names Of All Students From Database -->
							<ol>
					<?php foreach ($students as $student): ?>
					<li><a href="<?php echo base_url() . "index.php/update_ctrl/show_student_id/" . $student->student_id; ?>"><?php echo $student->student_name; ?></a></li>
					<?php endforeach; ?>
							</ol>
						</div>
				<div id="detail">
				<!-- Fetching All Details of Selected Student From Database And Showing In a Form -->
					<?php foreach ($single_student as $student): ?>
					<p>Edit Detail & Click Update Button</p>
					<form method="post" action="<?php echo base_url() . "index.php/update_ctrl/update_student_id1"?>">
						<label id="hide">Id :</label>
							<input type="text" id="hide" name="did" value="<?php echo $student->student_id; ?>">
						
						<label>Name :</label>
							<input type="text" name="dname" value="<?php echo $utm_users->name; ?>">
						
						<label>Email :</label>
							<input type="text" name="demail" value="<?php echo $utm_users->email; ?>">
						
						<input type="submit" id="submit" name="dsubmit" value="Update">
						
					</form>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</body>
</html>