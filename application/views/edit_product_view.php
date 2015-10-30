
<body>
<div class="container">
<div class="row">
	
</div>

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Info Update</h4>
			</div>
			<div class="panel-body">
				<?php foreach ($query as $row): ?>
							
				<form method="post" action="<?php echo base_url() . "products/save_edit_product"?>" >
				<div class="form-group">
                            <input type="hidden" value="<?php echo $row->pk_id  ?>" name="product_id">
                            <label >Product Name</label><br>
                            <input class="form-control" id="product_name" type="text" name="product_name" value="<?php echo $row->product_name ?>">
                            <p id= "iproduct_name"></p>
                        </div>

                        <div class="form-group">
                            <label >Product Price (RM) :</label><br>
                            <input  class="form-control" id="product_price" type="number" step="0.01" min="0"  name="product_price" value="<?php echo $row->price ?>">
                            <p id ="iproduct_price" ></p>                
                        </div>

                        <div class="form-group">      
                            <label >Product Quantity:</label><br>
                            <input class="form-control" id="product_quantity" type="number" step="1" min="1"  name="product_quantity" value="<?php echo $row->quantity ?>">
                            <p id ="iproduct_quantity" ></p>            
                        </div>

                        <div class="form-group">
                            <label >Category</label><br>
                            <select id="product_category" name="product_category">
                                <option value="<?php echo $row->category_id?>" title="$"> --Category--</option>
                                <?php foreach ($category_data as $row2) { ?>
                                <option value="<?php echo $row2->pk_id; ?>" title="$" ><?php echo $row2->category_name; ?></option>
                                <?php } ?>
                            </select>
                            <p id ="iproduct_category" ></p>
                        </div>

                        <div class="form-group">
                            <label >Product Description</label><br>
                            <textarea value = "<?php echo $row->description?>"id= "product_description" class="form-control" name="product_description"  rows="6"></textarea>
                            <p id ="iproduct_description" ></p>
                        </div>
                        <div class="form-group">
                            <input id ="submit" type="submit"  value="Save Product" name="submit">
                        </div>



				<?php echo form_close(); ?>
				<?php endforeach; ?>

			</div>
		</div>
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
    else if(!(price.match(/^\d{1,10}(\.\d{2})?$/i))){
        $("p#iproduct_price").css('color', 'red');
        $("p#iproduct_price").text('Only 2 decimal place value is allow');
        var h = false;
    }
    else{
        $("p#iproduct_price").text('');
        var h = true;
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




    var product_description = $("textarea#product_description").val();
    if (product_description == '' || product_description == null) {
        $("p#iproduct_description").css('color', 'red');
        $("p#iproduct_description").text('Enter the product description');
        var g = false;
    }
    else{
        $("p#iproduct_description").text('');
        var g = true; 
    }



    if (a == false || b == false || c==false|| d == false || g == false || h == false) {

        return  false;

    }else{
        return  true;
    }
}

jQuery(document).ready(function() {
    $('input#submit').click(function(e) {
        var validate_value = validation();
        if(validate_value==true){
        }else{
            e.preventDefault();
        }
    });
});

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