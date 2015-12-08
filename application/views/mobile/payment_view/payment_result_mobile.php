<body>
  <h4><?php echo $this->session->flashdata('msg');?></h4>
  <hr>
  <?php echo $result;?>
  <?php
    $list = "";
    $i = 1;
    if(isset($items)){
      foreach($items as $item){
        $list .= "<div class='row'>";
        $list .= "<div class='col-xs-offset-1 col-xs-1'>";
        $list .= $i++;
        $list .= "</div>";
        $list .= "<div class='col-xs-offset-1 col-xs-8'>";
        $list .= "<label>Product Name: </label>".$item['name']." <br>";
        $list .= "<label>item Quantity: </label>".$item['quantity']." <br>";
        $list .= "<label>Total Price: </label>RM".(number_format(($item['price'] * $item['quantity']), 2, '.', ''))." <br>";
        $list .= "</div>";
        $list .= "</div><hr>";
      }

      echo $list;
    }
  ?>
</body>
</html>
