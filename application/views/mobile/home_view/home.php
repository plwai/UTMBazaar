<body>
    <div class="container">
        <div class="row">

            <!--FEATURED ITEMS PANEL-->
            <div class="col-sm-9">
            <h2> Featured Items </h2>
                <div class="row">
                    <?php foreach ($product_list as $row) { ?>
                    <div class="row" >
                        <div class="col-sm-6" onclick="location.href='<?php echo base_url();?>products/load_details/<?php echo $row->pk_id;?>'">
                            <p style="font-size:24px;color:black;font-weight:bold"><?php echo $row->product_name; ?></p>
                            <p>
                                Price <span class="label label-info"> RM <?php echo $row->price; ?></span>
                            </p>
                        </div>
                        <div  class="col-sm-6" style="height:100% ;min-height: 100%;">
                            <button type="button" onclick="add_cart(<?php echo $row->pk_id; ?>)" class="btn btn-warning">
                                <span class="fa fa-cart-plus"></span> Add to Cart
                            </button>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function add_cart(id){
        $.ajax({
            type: "POST",
            url: "products/add_cart",
            dataType: 'json',
            data: {product_id:id}
            }).done(function(msg){
            if(msg.res==1){
                $("p#notify").css('color', 'red');
                $("p#notify").text('Add Cart Success');
                window.location.replace("<?php echo base_url('products/view_cart') ?>");
            }
            else{
                $("p#notify").css('color', 'red');
                $("p#notify").text('Add Cart Fail');
            }

         });
    };
</script>