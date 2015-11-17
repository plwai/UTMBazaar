<!-- Jquery Validation Plugin version-->
<script src="<?php echo base_url(); ?>assets/jquery validation/dist/jquery.validate.js"></script>

<!-- resetlink css-->
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/reset-pass.css'>

<body>
    <div class="col-md-offset-4 col-md-4 form-boder">
      <div class="col-md-offset-3">
        <h4>Password Reset</h4>
      </div>
      <hr>
			<?php echo form_open('account/reset_password', array('class' => 'form-inline ')); ?>
        <div class="form-group">
          <label class="control-label col-md-3 nopadding">Email Address:</label>
          <div class="col-md-6">
            <input type="email" class="form-control" name="email" id="email">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-default">Reset</button>
          </div>
        </div>

			<?php echo validation_errors(); ?>
			<?php echo $this->session->flashdata('errmsg'); ?>


			<?php echo form_close(); ?>
</body>

<!-- email validation javascript -->
<script src="<?php echo base_url(); ?>assets/javascript/validation/reset-email-validation.js"></script>


</html>
