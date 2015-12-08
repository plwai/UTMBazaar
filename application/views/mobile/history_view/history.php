<body>
  <?php
    if($type == "Seller"){
      echo "<h1>Item Sold</h1>";
    }
    else{
      echo "<h1>Item Bought</h1>";
    }

    echo "<hr>";

    $list = "";
    $i = 1;

    if(isset($history)){
      foreach($history as $item){
        $list .= "<div class='row'>";
        $list .= "<div class='col-xs-offset-1 col-xs-1'>".$i++;
        $list .= "</div>";
        $list .= "<div class='col-xs-8'>";
        $list .= "<label>Product Name: </label>".$item['name']." <br>";
        $list .= "<label>item Quantity: </label>".$item['quantity']." <br>";
        $list .= "<label>Total Price: </label>RM".(number_format(($item['price'] * $item['quantity']), 2, '.', ''))." <br>";
        $list .= "<label>Date: </label>".$item['date']."<br>";
        $list .= "<label>Time: </label>".$item['time']."<br>";
        $list .= "</div>";
        $list .= "</div><br><hr>";
      }

      echo $list;
    }
  ?>
</body>
</html>
