
<script src="<?php echo base_url(); ?>assets/jquery/jquery.simplePopup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/simplePopup.css">
<body>
    <div class="col-xs-11 col-xs-offset-1">
        <h2> Manage My Products </h2>

        <div class="accordion" id="accordion2">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#productdata">
                        Products Data
                    </a>
                </div>
                <div id="productdata" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        <div class="row">
                            <?php foreach ($query2 as $row) { ?>
                            <div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;" class="row" >
                                <div class="col-xs-5" style="padding-left: 0px;padding-right: 0px;"onclick="location.href='<?php echo base_url();?>products/load_details/<?php echo $row->pk_id;?>'">
                                    <p style="font-size:24px;color:black;font-weight:bold"><?php echo $row->product_name; ?></p>
                                    <p style="font-size:20px;color:grey;"><?php echo $row->description; ?></p>
                                </div>
                                <div  class="col-xs-1" style="padding-left: 0px;padding-right: 0px;" >    
                                    <form style="top:45%;position: absolute;" action="edit_products" method="post">
                                        <input type="hidden" value="<?php echo $row->pk_id; ?>" name="product_id">
                                        <button  type="submit" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-cog"></span> 
                                        </button>
                                    </form>
                                </div>
                                <div  class="col-xs-1"style="padding-left: 0px;padding-right: 0px;" >
                                    <form  style="top:45%;position: absolute;" action="edit_product_image" method="post">
                                        <input type="hidden" value="<?php echo $row->pk_id; ?>" name="product_id">
                                        <button  type="submit" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-film"></span> 
                                        </button>
                                    </form>
                                </div>
                                <div  class="col-xs-1"style="padding-left: 0px;padding-right: 0px;" >
                                    <form style="top:45%;position: absolute;" action="edit_products" method="post">
                                        <input type="hidden" value="<?php echo $row->pk_id; ?>" name="product_id">

                                        <button type="button" onclick="remove_event(<?php echo $row->pk_id; ?>)" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-trash"></span> 
                                        </button>
                                    </form>
                                </div>
                                <div  class="col-xs-1" style="padding-left: 0px;padding-right: 0px;" >
                                    <form style="top:45%;position: absolute;"  action="edit_products" method="post">
                                       <input type="hidden" value="<?php echo $row->pk_id; ?>" name="product_id">
                                       <button type="button" onclick="change_publish_state(<?php echo $row->pk_id; ?>,<?php echo $row->publish_state ?>)" class="btn btn-warning">
                                           <span   class="glyphicon glyphicon-asterisk"></span> <?php if($row->publish_state==1){echo "UP" ;}else{echo "P";}?>
                                       </button>
                                    </form>
                                </div>
                        
                            </div>

                            <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle"  href="add_products">
                        Add Products
                    </a>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#productimage">
                        Products Image
                    </a>
                </div>
                <div id="productimage" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div class="row">
                            <?php foreach ($query2 as $row) { ?>
                                <div style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;" class="row" onclick="location.href='<?php echo base_url();?>products/load_details/<?php echo $row->pk_id;?>'">
                                    <div class="col-sm-6">
                                        <p style="font-size:24px;color:black;font-weight:bold"><?php echo $row->product_name; ?></p>
                                        <p style="font-size:20px;color:grey;"><?php echo $row->description; ?></p>
                                    </div>

                                    <div  class="col-sm-6" >
                                        <form  style="top:45%;position: absolute;" action="edit_product_image" method="post">
                                            <input type="hidden" value="<?php echo $row->pk_id; ?>" name="product_id">
                                            <button  type="submit" class="btn btn-warning">
                                                <span class="glyphicon glyphicon-pencil"></span> Edit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#removeproducts">
                        Remove Products
                    </a>
                </div>
                <div id="removeproducts" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div class="row">
                            <?php foreach ($query2 as $row) { ?>
                            <div class="row" style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;" onclick="location.href='<?php echo base_url();?>products/load_details/<?php echo $row->pk_id;?>'">
                                <div class="col-sm-6">
                                    <p style="font-size:24px;color:black;font-weight:bold"><?php echo $row->product_name; ?></p>
                                    <p style="font-size:20px;color:grey;"><?php echo $row->description; ?></p>
                                </div>
                                <div  class="col-sm-6" >
                                    <form style="top:45%;position: absolute;" action="edit_products" method="post">
                                        <input type="hidden" value="<?php echo $row->pk_id; ?>" name="product_id">

                                        <button type="button" onclick="remove_event(<?php echo $row->pk_id; ?>)" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-trash"></span> Remove
                                        </button>

                                    </form>
                                </div> 
                            </div>
                            <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#publishproducts">
                        Publish products
                    </a>
                </div>
                <div id="publishproducts" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div class="row" style="">
                            <?php foreach ($query2 as $row) { ?>
                            <div class="row " style="display: -webkit-box;display: -webkit-flex;display: -ms-flexbox;display: flex;" onclick="location.href='<?php echo base_url();?>products/load_details/<?php echo $row->pk_id;?>'" class="well well-sm; " style="font-size:25px;">
                                <div  class="col-sm-6" >
                                    <p style="font-size:24px;color:black;font-weight:bold"><?php echo $row->product_name; ?></p>
                                    <p style="font-size:20px;color:grey;"><?php echo $row->description; ?></p>
                                </div>
                                <div  class="col-sm-6 " style="" >
                                    <form style="top:45%;position: absolute;"  action="edit_products" method="post">
                                       <input type="hidden" value="<?php echo $row->pk_id; ?>" name="product_id">
                                       <button type="button" onclick="change_publish_state(<?php echo $row->pk_id; ?>,<?php echo $row->publish_state ?>)" class="btn btn-warning">
                                           <span   class="glyphicon glyphicon-asterisk"></span> <?php if($row->publish_state==1){echo "unpushblish" ;}else{echo "pubish";}?>
                                       </button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

        <div id="delete_product_pop" style="display: none;" class="simplePopup">

            <div class="fg-box first">
                <p class="fg-box-header relative rl-pad">Deleting Product</p>
                <div class="fg-inner-box rl-pad">

                        <div class="fg-row">
                            <center> <label class="block fg-label">Are you sure..? <br>
                                    <br>You want to delete this Product</label>

                                <input type="hidden" name="product_id" id="del_product_id" value=""/>
                                <p id="respond"></p>
                                <div><br><input id="del_submit" type="submit" value="Yes" class="fg-btn inline medium green" />  <a href="<?php echo base_url(); ?>products/mineproduct" id="cancel_delete" class="fg-btn orange medium inline">No</a></div>
                            </center>

                        </div>


                </div>
            </div>
        </div>



<script>
    function remove_event(id) {
        $('#del_product_id').val(id);
        $('#delete_product_pop').simplePopup();
    };
    function change_publish_state(id,states) {
                $.ajax({
                type: "POST",
                url: "change_product_state",
                dataType: 'json',
                data: {product_id:id, state:states}
                }).done(function(msg){
                    if(msg.res==0){
                        location.reload(true);
                    }
                    if(msg.res==1){

                      location.reload(true);
                    }
                });
    };

</script>
<script>
$(document).ready(function(){

    

    $('input#del_submit').click(function(e){

                $.ajax({
                type: "POST",
                url: "remove_product",
                dataType: 'json',
                data: {product_id:$("#del_product_id").val()}
                }).done(function(msg){
                    if(msg.res==0){
                        $("p#respond").css('color', 'red');
                        document.getElementById("respond").innerHTML=" error ";
                    }
                    if(msg.res==1){
                      document.getElementById("respond").innerHTML=" Remove succsuful ";
                      location.reload(true);
                    }
                });

    });

});
</script>
<script>
$(document).ready(function() {
    if(location.hash) {
        $('a[href=' + location.hash + ']').tab('show');
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on('popstate', function() {
    var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
    $('a[href=' + anchor + ']').tab('show');
});
</script>
<script>

</script>