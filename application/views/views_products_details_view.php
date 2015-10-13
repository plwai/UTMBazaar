
                    <div class="row">
                    <?php foreach ($query as $row) { ?>
                        <div class="col-md-4" >
                            <a class="thumbnail">
                                <div class="well well-sm"><?php echo $row->product_name; ?></div>
                                <div class="magnify">
                                <div class="large"></div>
                                <img class="small"  id = "current_image"src="<?php echo $row->main_product_image; ?>" >
                                <?php 
                                    $this->load->helper('directory'); //load directory helper
                                    $dir = $row->product_image; // Your Path to folder
                                    $map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */

                                    foreach ($map as $k)
                                    {
                                ?>
                                        <img src="<?php echo base_url().$dir.$k;?>" alt="" onclick="active_image(this.src)" style="width:75px;height:75px"><br>
                                       
                                    <?php }
                                          
                                ?>
                                </div>
                                <p>
                                    Price <span class="label label-info">RM : <?php echo $row->product_price; ?></span>
                                </p>
                                <p>
                                    Product Category <span class="label label-info"> : <?php echo $row->type; ?></span>
                                </p>
                                <p>
                                    Product Quantity <span class="label label-info"> : <?php echo $row->product_quantity; ?></span>
                                </p> 
                                <p>
                                    Product Description <span class="label label-info"> : <?php echo $row->product_description; ?></span>
                                </p>
                                <p>
                                    user Sell <span class="label label-info"> : <?php echo $row->name; ?></span>
                                </p> 
                                <p>
                                    Dead Added <span class="label label-info"> : <?php echo $row->date_added; ?></span>
                                </p>                                           
                                <button type="button" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                                </button>
                            </a>
                        </div>

 <?php } ?>
                    </div>

<script>
    function active_image(address){
        document.getElementById("current_image").src = address;
    }
</script>