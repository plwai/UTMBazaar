<html>
	<head>
		<title>Registration UTM BazaaR</title>
		<script type="text/javascript" src="<?php echo base_url();?>assets/\jquery/jquery-1.11.3.js" ></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets\javascript\validation/registration-validation.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/registration.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/main.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url("assets/bootstrap-3.3.5-dist\css/bootstrap.css"); ?>" />

	</head>
	<body>
		<div class="container-fluid">
			<!--THIS IS HEADER-->
            		<div class="header_top"><!--header_top-->
				<div class="container">
                    			<div class="row">
						<div class="col-sm-6">
                            				<div class="contactinfo">
								<ul class="nav nav-pills">
                                    					<li><a href="#"><i class="fa fa-graduation-cap"></i> Universiti Teknologi Malaysia</a></li>
								</ul>
                            				</div>
                        			</div>
                        			<div class="col-sm-6">
                            				<div class="social-icons pull-right">
                                				<ul class="nav navbar-nav">
                                    					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    					<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
                            				</div>
						</div>
                    			</div>
				</div>
            		</div><!--/header_top-->
            		<div id="header" class="jumbotron">
                		<h1>UTM BAZAAR</h1>
                		<!-- <img class="img-responsive" src=""> -->
            		</div>
            		<!--THIS IS NAVIBAR-->
            		<nav class="navbar navbar-default topmenu">
                		<div class="container-fluid">
                    			<div class="navbar-inner">
                        			<div class="navbar-header">
                            				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#pageNavi">
                                				<span class="icon-bar"></span>
                                				<span class="icon-bar"></span>
                                				<span class="icon-bar"></span> 
                            				</button>
                            				<a class="navbar-brand" href="#">UTM BAZAAR</a>
                        			</div>
                        			<div class="collapse navbar-collapse" id="pageNavi">
                            				<ul class="nav navbar-nav">
                                				<li><a href="index.html"><span class="fa fa-home"></span> Home</a></li>
                                				<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-chevron-circle-down"></span> Featured Item List </a>
                                    					<ul class="dropdown-menu">
                                        					<li><a href="#">Sort by Poularity</a></li>
                                        					<li><a href="#">Sort by Newest</a></li>
                                    					</ul>
                                				</li>
                            				</ul>
                            				<ul class="nav navbar-nav navbar-right">
                                				<li><a href="login.html"><span class="fa fa-sign-in"></span> Login</a></li>
                                				<li><a href="#"><span class="fa fa-edit"></span> Register</a></li>
                            				</ul>
                        			</div>
                    			</div>
                		</div>
            		</nav>
            		<!--THIS IS MIDDLE PANEL-->
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>UTM BaZaar Registration</h4>
						</div>
						<div class="panel-body">
							<div id="validation-error"></div>
							<form method="post" action="register" id="registratio_form">

								<div class="form-group">
									<h5>First Name : </h5>
									<input type="text" name="sirname"  id="sirname" />
									<span id="usr_verify1" class="verify"></span><div class="text-danger" id="sirnametxt">
								</div>

								<div class="form-group">
									<h5>Last Name: </h5>
									<input type="text" name="name" id="name"    />
									<span id="usr_verify2" class="verify"></span><div class="text-danger" id="nametxt">
								</div>

								<div class="form-group">
									<h5>Email Address  : </h5>
									<input type="text" name="e-mail" id="e-mail"/>
									<span id="usr_verify3" class="verify"></span><div class="text-danger" id="e-mailtxt">
								</div>

								<div class="form-group">
									<h5>Confirma Email : </h5>
									<input type="text" name="email" id="email"/>
									<span id="usr_verify4" class="verify"></span><div class="text-danger" id="emailtxt">
								</div>

								<div class="form-group">
									<h5>Password : </h5>
									<input type="Password" name="password" id="password"  />
									<span id="usr_verify5" class="verify"></span><div class="text-danger" id="passwordtxt">
								</div>

								<div class="form-group">
									<h5>Type it again : </h5>
									<input type="password" name="passconf" id="passconf"  />
									<span id="usr_verify6" class="verify"></span><div class="text-danger" id="passconftxt">
								</div>

								<div class="form-group">
									<input type="submit" id="submit" onclick="submit()" value="Submit" /><input type="submit" id="cancel" onclick="cancel()" value="cancel" />
									<div id="submittxt">	
								</div>
								
							</form>


						</div>
					</div>
				</div>
			</div>
			<!--THIS IS FOOTER-->
            		<div id="footer">
                		<p>Copyrighted© Universiti Teknologi Malaysia</p>
            		</div>
		</div>
	</body>
</html>

