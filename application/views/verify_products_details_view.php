<script src="<?php echo base_url(); ?>assets/jquery/jquery-1.11.3.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets\javascript\jquery.magnifier.js"></script>

<div class="row">
    <?php foreach ($query as $row){ ?>
        <div class="col-md-6  col-md-offset-3" >
            <a class="thumbnail">
                <div class="well well-sm"><?php echo $row->product_name; ?></div>
                <img   class ="current_image" id = "current_image"src="<?php echo $row->main_product_image; ?>" >

                <?php
                $this->load->helper('directory'); //load directory helper
                $dir = $row->image; // Your Path to folder
                $map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */
                ?>

                <div class="row">
                    <div  class=" col-md-2"></div>
                  <?php if($map){ ?>
                    <?php foreach ($map as $k){ ?>
                        <div class="col-md-2 " >
                            <img class="magnify" src="<?php echo base_url().$dir.$k;?>" alt=""  style="width:85px;height:85px">
                        </div>
                    <?php } ?>
                  <?php } ?>
                </div>

                <div >
                    <p>
                        Price <span class="label label-info">RM : <?php echo $row->price; ?></span>
                    </p>
                    <p>
                        Product Category <span class="label label-info"> : <?php echo $row->category_name; ?></span>
                    </p>
                    <p>
                        Product id <span class="label label-info"> : <?php echo $row->pk_id; ?></span>
                    </p>
                    <p>
                        Product Quantity <span class="label label-info"> : <?php echo $row->quantity; ?></span>
                    </p>
                    <p>
                        Product Description <span class="label label-info"> : <?php echo $row->description; ?></span>
                    </p>
                    <p>
                        user Sell <span class="label label-info"> : <?php echo $row->name; ?></span>
                    </p>
                    <p>
                        Dead Added <span class="label label-info"> : <?php echo $row->date_added; ?></span>
                    </p>

                    <button type="button" onclick="verify(<?php echo $row->pk_id; ?>,  1)">Verify</button>
                    <button type="button" onclick="verify(<?php echo $row->pk_id; ?>, 2)">Reject</button>
                    <p class="notify" id="notify"></p>
                </div>
            </a>
        </div>
    <?php } ?>
</div>

<script>
    function verify(id, v_status){
		$.ajax({
				type: "POST",
				url: "../change_verify_status",
				dataType: 'json',
				data: {product_id: id,status:v_status}
			}).done(function(msg){;
			   window.location.replace("http://localhost/UTMBazaar/products/view_verify_products");
			});
	
    }
</script>
