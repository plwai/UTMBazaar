<?php
  $list = "";
  if($orderList){
    foreach($orderList as $order){
      $list .= "<div class='row'>";
      $list .= "<div class='col-sm-offset-3 col-sm-3'>";
      $list .= "<img src='".$order['image']."' height='200' width='200'></img> <br>";
      $list .= "</div>";
      $list .= "<div class='col-sm-5'><br><br><br>";
      $list .= "<label>Product Name: </label>".$order['name']." <br>";
      $list .= "<label>Order Quantity: </label>".$order['quantity']." <br>";
      $list .= "<label>Total Price: </label>RM".(number_format(($order['price'] * $order['quantity']), 2, '.', ''))." <br>";
      $list .= "<input type='hidden' name='order_id[]' id='order_id[]' value=".$order['id']."> <br>";
      $list .= "</div>";
      $list .= "</div><br><br>";
    }
  }
  else{
    $list = "No order";
  }
?>

<body>
  <?php if($list == "No order"){ echo $list; }else{ ?>
  <?php echo form_open('pay_item'); ?>
    <?php echo $list; ?>
    <hr>
    <div class='row'>
    <div class='col-sm-offset-5'>
      <input type='submit'>
    </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
  <?php echo form_close(); ?>
  <?php }?>
</body>
</html>
