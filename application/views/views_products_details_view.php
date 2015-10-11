 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <div class="row">
                    <?php foreach ($query as $row) { ?>
                        <div class="col-md-4" >
                            <a class="thumbnail">
                                <div class="well well-sm"><?php echo $row->product_name; ?></div>
                                <div class="large"></div>
                                <img class="small" id = "current_image"src="<?php echo $row->main_product_image; ?>" >
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
                    <script type="text/javascript">$(document).ready(function(){

var native_width = 0;
var native_height = 0;

//Now the mousemove function
$(".magnify").mousemove(function(e){
    //When the user hovers on the image, the script will first calculate
    //the native dimensions if they don't exist. Only after the native dimensions
    //are available, the script will show the zoomed version.
    if(!native_width && !native_height)
    {
        //This will create a new image object with the same image as that in .small
        //We cannot directly get the dimensions from .small because of the 
        //width specified to 200px in the html. To get the actual dimensions we have
        //created this image object.
        var image_object = new Image();
        image_object.src = $(".small").attr("src");

        //This code is wrapped in the .load function which is important.
        //width and height of the object would return 0 if accessed before 
        //the image gets loaded.
        native_width = image_object.width;
        native_height = image_object.height;
    }
    else
    {
        //x/y coordinates of the mouse
        //This is the position of .magnify with respect to the document.
        var magnify_offset = $(this).offset();
        //We will deduct the positions of .magnify from the mouse positions with
        //respect to the document to get the mouse positions with respect to the 
        //container(.magnify)
        var mx = e.pageX - magnify_offset.left;
        var my = e.pageY - magnify_offset.top;

        //Finally the code to fade out the glass if the mouse is outside the container
        if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
        {
            $(".large").fadeIn(100);
        }
        else
        {
            $(".large").fadeOut(100);
        }
        if($(".large").is(":visible"))
        {
            //The background position of .large will be changed according to the position
            //of the mouse over the .small image. So we will get the ratio of the pixel
            //under the mouse pointer with respect to the image and use that to position the 
            //large image inside the magnifying glass
            var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
            var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
            var bgp = rx + "px " + ry + "px";

            //Time to move the magnifying glass with the mouse
            var px = mx - $(".large").width()/2;
            var py = my - $(".large").height()/2;
            //Now the glass moves with the mouse
            //The logic is to deduct half of the glass's width and height from the 
            //mouse coordinates to place it with its center at the mouse coordinates

            //If you hover on the image now, you should see the magnifying glass in action
            $(".large").css({left: px, top: py, backgroundPosition: bgp});
        }
    }
})