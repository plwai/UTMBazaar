<body>
  <?php echo $this->session->flashdata('msg');?>
  <?php echo $result;?>
  <?php
    $list = "";

    if(isset($items)){
      foreach($items as $item){
        $list .= "<div class='row'>";
        $list .= "<div class='col-sm-offset-3 col-sm-3'>";
        $list .= "<img src='".$item['image']."' height='200' width='200'></img> <br>";
        $list .= "</div>";
        $list .= "<div class='col-sm-5'><br><br><br>";
        $list .= "<label>Product Name: </label>".$item['name']." <br>";
        $list .= "<label>item Quantity: </label>".$item['quantity']." <br>";
        $list .= "<label>Total Price: </label>RM".(number_format(($item['price'] * $item['quantity']), 2, '.', ''))." <br>";
        $list .= "<input type='hidden' name='item_id[]' id='item_id[]' value=".$item['id']."> <br>";
        $list .= "</div>";
        $list .= "</div><br><br>";
      }

      echo $list;
    }
  ?>
</body>
</html>
