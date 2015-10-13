<body>
  <?php echo form_open('pay_item'); ?>
    <input type='hidden' name='order_id[]' id='order_id[]' value=1>
  <input type='hidden' name='order_id[]' id='order_id[]' value=2>
    <input type='submit'>
  <?php echo form_close(); ?>
</body>
</html>
