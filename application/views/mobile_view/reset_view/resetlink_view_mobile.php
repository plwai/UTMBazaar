<!-- Jquery Validation Plugin version-->
<script src="<?php echo base_url(); ?>assets/jquery validation/dist/jquery.validate.js"></script>

<!-- resetlink css-->
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/reset-pass.css'>

<body>
      <div class="col-sm-offset-3 col-sm-5 form-boder">
        <div class="col-sm-offset-3">
          <h4>Password Reset</h4>
        </div>
        <hr>
        <?php echo form_open('account/change_password', array('class' => 'form-horizontal ')); ?>

        <div class="form-group">
          <label class="control-label col-sm-4">New Password:</label>
          <div class="col-sm-7">
            <input type='password' class="form-control" name='pass' id='pass'>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4">Retype Password:</label>
          <div class="col-sm-7">
            <input type='password' class="form-control" name='pass_re' id='pass_re'>
          </div>
        </div>

        <input type='hidden' name='id' value='<?php echo $id; ?>'>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>

        <?php echo form_close(); ?>
      </div>
</body>

<!-- Password validation javascript -->
<script src="<?php echo base_url(); ?>assets/javascript/validation/reset-validation.js"></script>

</html>
