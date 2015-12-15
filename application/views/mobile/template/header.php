<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- bootstrap-3.3.5 css-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-3.3.5-dist/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/main.css" />

  <!-- Jquery 1.11.3-->
  <script src="<?php echo base_url(); ?>assets/jquery/jquery-1.11.3.js"></script>

  <!-- bootstrap-3.3.5 js-->
  <script src="<?php echo base_url(); ?>assets/bootstrap-3.3.5-dist/js/bootstrap.js"></script>

  <div class="container-fluid">


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
            <a class="navbar-brand" href=<?php echo base_url() ?>>UTM BAZAAR</a>
          </div>
          <div class="collapse navbar-collapse" id="pageNavi">
            <ul class="nav navbar-nav">
              <li><a href=<?php echo base_url(); ?>><span class="fa fa-home"></span> Home</a></li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-chevron-circle-down"></span> Featured Item List </a>
              <ul class="dropdown-menu">
                <li><a href="#">Sort by Poularity</a></li>
                <li><a href="#">Sort by Newest</a></li>
              </ul>
              </li>
              <?php if(isset($username)){
                echo "<li><a href=".base_url()."products/mineproduct><span class='fa fa-home'></span> My Product</a></li>";
                echo "<li><a href=".base_url()."products/view_cart><span class='fa fa-home'></span> My Cart</a></li>";
                echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'><span class='fa fa-chevron-circle-down'></span>History</a>";
                echo "<ul class='dropdown-menu'>";
                echo "<li><a href=".base_url()."history><span class='fa fa-home'></span> Item Sold</a></li>";
                echo "<li><a href=".base_url()."history/view_history/Buyer><span class='fa fa-home'></span> Item Bought</a></li>";
                echo "</ul>";
                echo "</li>";
                echo "<li><a href=".base_url()."pay_item/view_list><span class='fa fa-home'></span> My Order</a></li>";
              } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php
              if(!isset($username))
              {
                echo "<li><a href=".base_url('account')."><span class='fa fa-sign-in'></span> Login</a></li>";
                echo "<li><a href=".base_url('account/register')."><span class='fa fa-edit'></span> Register</a></li>";
              }
            else{
					    echo "<li><a href='".base_url()."account/logout' class='header'><span class='fa fa-sign-in'></span>Logout</a></li>";
						echo "<li><a href='".base_url()."account/show_user' class='header'><span class='fa fa-sign-in'></span> Edit Account</a></li>";
            }
            ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!--THIS IS MIDDLE PANEL-->
</head>
