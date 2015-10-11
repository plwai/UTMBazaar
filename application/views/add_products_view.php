
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
<script>
function validation(){
    var name = $("input#product_name").val();
    if (name == '' || name == null) {
        $("p#iproduct_name").css('color', 'red');
        $("p#iproduct_name").text('Please Enter product Name');
        var a = false;
    }
    else{
        $("p#iproduct_name").text('');
        var a = true;
    }
        
    var price = $("input#product_price").val();
    if (price == '' || price == null) {
        $("p#iproduct_price").css('color', 'red');
        $("p#iproduct_price").text('Please Enter product price');
        var b = false;
    }
    else{
        $("p#iproduct_price").text('');
        var b = true;
    }
    
    var quantity = $("input#product_quantity").val();
    if (quantity == '' || quantity == null) {
        $("p#iproduct_quantity").css('color', 'red');
        $("p#iproduct_quantity").text('Please Enter product quantity');
        var c = false;
    }
    else{
        $("p#iproduct_quantity").text(''); 
        var c = true;
    }

    var product_category = $("select#product_category").val();
    if (product_category == '' || product_category == null) {
        $("p#iproduct_category").css('color', 'red');
        $("p#iproduct_category").text('Select Any Product Category');
        var d = false;
    }
    else{
        $("p#iproduct_category").text(''); 
        var d = true;
    }



    var pic = $("input#up_file").val();
    if (pic == '' || pic == null) {
        $("p#iup_file").css('color', 'red');
        $("p#iup_file").text('Select And Upload a pictures related to the product');
        var f = false;
    }
    else{
        $("p#iup_file").text('');
        var f = true;
        var uploadedFile = document.getElementById('up_file');
        var fileSize = uploadedFile.files[0].size;

        if(fileSize >100000){
            var h = false;
            $("p#file_siez_text").css('color', 'red');
            $("p#file_siez_text").text('File size too big');
        }else{
            var h = true;
            $("p#file_siez_text").text('');
        }
        if(ValidateSingleInput(document.getElementById('up_file'))){
            var i = true;
            $("p#file_format_text").text('');
        }else{
            var i = false;
            $("p#file_format_text").css('color', 'red');
            $("p#file_format_text").text('File format invalid');
        }
    }

    var product_description = $("textarea#product_description").val();
    if (product_description == '' || product_description == null) {
        $("p#iproduct_description").css('color', 'red');
        $("p#iproduct_description").text('Select Any Product Year');
        var g = false;
    }
    else{
        $("p#iproduct_description").text('');
        var g = true; 
    }



    if (a == false || b == false || c==false|| d == false || e == false || f == false|| g == false) {
        return  false;

    }else{
        return  'true';
    }
}
</script>
        
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('input#submit').click(function(e) {
            var validate_value = validation();
            if(validate_value=='true'){
            }else{
                e.preventDefault();
            }
        });
    });
</script>

<script>
var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                return false;
            }
        }
    }
    return true;
}
</script>

