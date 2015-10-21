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



    var pic = $("input#up_file").val();
    if (document.getElementById("up_file").files.length < 1) {

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
        $("p#iproduct_description").text('Enter the product description');
        var g = false;
    }
    else{
        $("p#iproduct_description").text('');
        var g = true; 
    }



    if (a == false || b == false || c==false|| d == false || f == false||h==false|| i==false|| g == false || h == false) {

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
