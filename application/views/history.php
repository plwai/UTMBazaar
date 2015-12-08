<body>
  <?php
    if($type == "Seller"){
      echo "<h1>Item Sold</h1>";
    }
    else{
      echo "<h1>Item Bought</h1>";
    }

    $list = "";

    if(isset($history)){
      foreach($history as $item){
        $list .= "<div class='row'>";
        $list .= "<div class='col-sm-offset-3 col-sm-3'>";
        $list .= "<img src='".$item['image']."' height='200' width='200'></img> <br>";
        $list .= "</div>";
        $list .= "<div class='col-sm-5'><br><br><br>";
        $list .= "<label>Product Name: </label>".$item['name']." <br>";
        $list .= "<label>item Quantity: </label>".$item['quantity']." <br>";
        $list .= "<label>Total Price: </label>RM".(number_format(($item['price'] * $item['quantity']), 2, '.', ''))." <br>";
        $list .= "<label>Date: </label>".$item['date']."<br>";
        $list .= "<label>Time: </label>".$item['time']."<br>";
        $list .= "</div>";
        $list .= "</div><br><br>";
      }

      echo $list;
    }
  ?>
</body>
</html>
