<!-- Jquery Validation Plugin version-->
<script src="<?php echo base_url(); ?>assets/jquery validation/dist/jquery.validate.js"></script>

<!-- resetlink css-->
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/reset-pass.css'>

<body>
    <div class="form-boder">
      <div>
        <h4>Password Reset</h4>
      </div>
      <hr>
			<?php echo form_open('account/reset_password'); ?>
        <div class="form-group">
          <label class="control-label">Email Address:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
            <br>
            <button type="submit" class="btn btn-block btn-default">Reset</button>
        </div>

			<?php echo validation_errors(); ?>
			<?php echo $this->session->flashdata('errmsg'); ?>


			<?php echo form_close(); ?>
    </div>
</body>

<!-- email validation javascript -->
<script src="<?php echo base_url(); ?>assets/javascript/validation/reset-email-validation.js"></script>


</html>
