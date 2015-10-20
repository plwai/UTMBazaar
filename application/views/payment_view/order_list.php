<?php
  $list = "";

  foreach($orderList as $order){
    $list .= "<label>Product Name: </label>".$order['name']." <br>";
    $list .= "<label>Order Quantity: </label>".$order['quantity']." <br>";
    $list .= "<label>Total Price: </label>RM".(number_format(($order['price'] * $order['quantity']), 2, '.', ''))." <br>";
    $list .= "<input type='hidden' name='order_id[]' id='order_id[]' value=".$order['id']."> <br>";
  }
?>

<body>
  <?php echo form_open('pay_item'); ?>
    <?php echo $list; ?>
    <input type='submit'>
  <?php echo form_close(); ?>
</body>
</html>
