<body>
    <div class="col-sm-9">
        <h2> Featured Items </h2>

         <div class="row">
            <?php foreach ($query as $row) { ?>
                <div class="col-md-4" onclick="location.href='<?php echo base_url();?>products/load_details/<?php echo $row->pk_id;?>'">
                    <a class="thumbnail">

                        <div class="well well-sm"><?php echo $row->product_name; ?></div>
                        <img src="<?php echo $row->main_product_image; ?>" style="width:150px;height:150px">
                        <p>
                            Price <span class="label label-info">RM : <?php echo $row->price; ?></span>
                        </p>
                                    
                        <button type="button" class="btn btn-warning">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart
                        </button>
                    </a>
                </div>

            <?php } ?>
        </div>

        <div class="row">
            <ul class="pager">
                <li class="previous"><a href="#">Previous</a></li>
                <li class="next"><a href="#">Next</a></li>
            </ul>
        </div>
    </div>
