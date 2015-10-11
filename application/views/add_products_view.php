
<html>
    <head>
        <script type="text/javascript" src="<?php echo base_url();?>/assets/jquery/jquery-1.11.3.js" ></script>
        <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap-3.3.5-dist\css/bootstrap.css"); ?>" />
    </head>
    <body>
        <div class="row col-md-6 col-md-offset-3 container">
            <div id="validation-error"></div>
                <div id="right-section-wrapper" class="panel panel-default">
                    <div class="panel-heading" >
                        <h2>Add Product</h2>
                    </div>
                    <div class="panel-body">           
                        <p> Product Information</p>
                        <?php echo form_open_multipart('products/save_product',array('id'=>'form'));?>
                        <div class="form-group">
                            <label >Product Name</label><br>
                            <input class="form-control" id="product_name" type="text" name="product_name" value="">
                            <p id= "iproduct_name"></p>
                        </div>

                        <div class="form-group">
                            <label >Product Price (RM) :</label><br>
                            <input  class="form-control" id="product_price" type="number" step="0.01" min="0"  name="product_price" value="">
                            <p id ="iproduct_price" ></p>                
                        </div>

                        <div class="form-group">      
                            <label >Product Quantity:</label><br>
                            <input class="form-control" id="product_quantity" type="number" step="1" min="1"  name="product_quantity" value="">
                            <p id ="iproduct_quantity" ></p>            
                        </div>

                        <div class="form-group">
                            <label >Category</label><br>
                            <select id="product_category" name="product_category">
                                <option value="" title="$"> --Category--</option>
                                <?php foreach ($category_data as $row) { ?>
                                <option value="<?php echo $row->id; ?>" title="$" ><?php echo $row->type; ?></option>
                                <?php } ?>
                            </select>
                            <p id ="iproduct_category" ></p>
                        </div>



                        <div class="form-group">
                        <label>Product Image</label><br>
                        <div class="fg-upload-parent">
                            <input id="up_file"  multiple="" type="file" name="up_file[]"  style="visibility:hidden; height:0px !important;" onchange="document.getElementById('import_file_text').value = this.value;">  
                            <input  id="import_file_text" placeholder="" type="text" onclick="document.getElementById('up_file').click();" readonly>
                            <span class="fg-upload-btn " onclick="document.getElementById('up_file').click();">Choose</span>
                        </div>
                        <p id ="iup_file" ></p>
                        <p id = "file_siez_text"></p>
                        <p id = "file_format_text"></p>
                        </div>

                        <div class="form-group">
                            <label >Product Description</label><br>
                            <textarea id= "product_description" class="form-control" name="product_description"  rows="6"></textarea>
                            <p id ="iproduct_description" ></p>
                        </div>

                        <?php echo $error;?>
                        <div class="form-group">
                            <input id ="submit" type="submit"  value="Save Product" name="submit">
                        </div>
                        </form>
                                   
                    </div>
            </div>
        </div>

    </body>
</html>


