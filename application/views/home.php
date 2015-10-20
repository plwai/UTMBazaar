<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                
                <h2> Categories </h2>
                <div class="list-group">
                    <?php foreach ($category_data as $row) { ?>
                    <a href="<?php echo base_url();?>search/by_category/<?php echo $row->pk_id;?>" class="list-group-item"> <?php echo $row->category_name; ?> </a>
                    <?php } ?>
                </div>
                
                <h4> Looking for something? </h4>
                <?php 
                $attributes = array('class' => 'form-inline', 'role' => 'form');
                echo form_open('search', $attributes); 
                ?>
                    <div class="form-group">
                        <?php 
                        $srch = array(
                            'name'        => 'search-query',
                            'id'          => 'search-query',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter keyword here',
                        );

                        echo form_input($srch);
                        ?>
                    </div>
                    <?php 
                        $btn = array(
                            'name'  => 'search-product',
                            'id'    => 'search-product',
                            'class' => 'btn btn-warning',
                            'value' => 'Search',
                        );

                        echo form_submit($btn);
                        echo form_close(); ?>
                
                <button data-toggle="collapse" data-target="#search_option">Search tools</button>
                <div id="search_option" class="collapse">
                    <form role="form">
                        <div class="checkbox">
                            <label><input type="checkbox" value="">Option 1</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="">Option 2</label>
                        </div>
                    </form>
                </div>
            </div>
            
            <!--FEATURED ITEMS PANEL-->
            <div class="col-sm-9">
            <h2> Featured Items </h2>
                <div class="row">
                    <?php foreach ($product_list as $row) { ?>
                    <div class="col-md-4" onclick="location.href='<?php echo base_url();?>products/load_details/<?php echo $row->pk_id;?>'">
                        <a class="thumbnail">
                            <div class="well well-sm"><?php echo $row->product_name; ?></div>  
                            <!-- check image availability -->
                            <?php 
                                $img = $row->image;
                                if($img != NULL){
                            ?>
                            <img alt="product" src="<?php echo $row->image; ?>" style="width:150px;height:150px">
                                <?php } else { ?>
                            <img alt="product" src="<?php echo base_url();?>assets/image/no-image.jpg" style="width:150px;height:150px">
                                <?php } ?>
                            <p>
                                Price <span class="label label-info"> RM <?php echo $row->price; ?></span>
                            </p>
                            <button type="button" class="btn btn-warning">
                                <span class="fa fa-cart-plus"></span> Add to Cart
                            </button>
                        </a>
                    </div>        
                    <?php } ?>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url(); ?>assets/search/search-product.js"></script>
</body>
