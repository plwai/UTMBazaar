

<body>
  <h3>Order List</h3>
  <?php
    $i = 1;
    if($orderList){
      echo form_open('pay_item');
      $start = microtime(true);
      echo "<hr>";
      foreach($orderList as $order){
        echo "<div class='row data' style='display:none; margin-bottom: 10px'>
        <div class='col-xs-offset-1 col-xs-1'>
        ".$i++."
        </div>
        <div class='col-xs-offset-1 col-xs-8'>
        <div class='row'>
        <label>Product Name: </label>".$order['name']."
        </div>
        <div class='row'>
        <label>Order Quantity: </label>".$order['quantity']."
        </div>
        <div class='row'>
        <label>Total Price: </label>RM".(number_format(($order['price'] * $order['quantity']), 2, '.', ''))."
        </div>
        <input type='hidden' name='order_id[]' id='order_id[]' value=".$order['id'].">
        </div>
        </div>
        <hr>";
      }
     echo "
        <div class='form-group'>
          <button class='btn btn-block btn-default' type='submit'>Pay Now</button>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>";
      echo form_close();
      //echo "Completed in ", microtime(true) - $start, " Seconds\n";
      //echo 'Elapsed time: '.$this->benchmark->elapsed_time();
    }
    else{
      echo "No order";
    }
  ?>
</body>
</html>

<script>
    var y = 0;

    document.body.onload = function(){
      var x = document.getElementsByClassName("data");

      for(var i = 0; i < 20; i++){
        x[y].style.display = "block";
        y++;
      }
    }

    $(window).scroll(function() {
       if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
         var x = document.getElementsByClassName("data");

         for(var i = 0; i < 1000; i++){
           x[y].style.display = "block";
           y++;
         }
       }
    });
</script>
