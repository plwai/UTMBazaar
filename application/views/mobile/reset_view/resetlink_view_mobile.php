<!-- Jquery Validation Plugin version-->
<script src="<?php echo base_url(); ?>assets/jquery validation/dist/jquery.validate.js"></script>

<!-- resetlink css-->
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/reset-pass.css'>

<body>
      <div class="col-sm-offset-3 col-sm-5 form-boder">
        <div class="col-sm-offset-3">
          <h3>Password Reset</h3>
        </div>
        <hr>
        <?php echo form_open('account/change_password', array('class' => 'form-horizontal ')); ?>

        <div class="form-group">
          <label class="control-label col-sm-4">New Password:</label>
            <input type='password' class="form-control" name='pass' id='pass'>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4">Retype Password:</label>
            <input type='password' class="form-control" name='pass_re' id='pass_re'>
        </div>

        <input type='hidden' name='id' value='<?php echo $id; ?>'>

        <div class="form-group">
            <button type="submit" class="btn btn-block  btn-default">Submit</button>
        </div>

        <?php echo form_close(); ?>
      </div>
</body>

<!-- Password validation javascript -->
<script src="<?php echo base_url(); ?>assets/javascript/validation/reset-validation.js"></script>

</html>
