<script src="<?php echo base_url(); ?>assets/jquery/jquery.simplePopup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/global.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />
<html>
    <body>
      <div class="row">

              <div class="col-md-6  col-md-offset-3" >
                  <a class="thumbnail">
                      <div class="well well-sm"><?php echo $product_name; ?></div>
                      <img   class ="current_image" id = "current_image" src="<?php echo $mainpath; ?>" >

                      <?php
                      $this->load->helper('directory'); //load directory helper
                      $dir = $path; // Your Path to folder
                      $map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */
                      ?>
                      <p><?php echo $state ?></p>
                      <div class="row">
                          <div  class=" col-md-2"></div>
                        <?php if($map){ ?>
                          <?php foreach ($map as $k){ ?>
                              <div class="col-md-2 " >
                                  <img class="magnify" src="<?php echo base_url().$dir.$k;?>" alt=""  style="width:85px;height:85px">
                                  <form  action="remove_image" method="post">
                                  <input type="hidden" value="<?php echo base_url().$dir.$k;?>" name="image_url">
                                  <input type="hidden" value="<?php echo $pk_id; ?>" name="product_id">
                                  <button  type="submit" class="btn btn-warning">
                                      <span class="glyphicon glyphicon-trash"></span> Remove
                                  </button>
                                  </form>
                                  <form  action="change_image" method="post">
                                  <input type="hidden" value="<?php echo base_url().$dir.$k;?>" name="image_url">
                                  <input type="hidden" value="<?php echo $pk_id; ?>" name="product_id">
                                  <button  type="submit" class="btn btn-warning">
                                      <span class="glyphicon glyphicon-trash"></span> Set
                                  </button>
                                  </form>

                              </div>
                          <?php } ?>
                        <?php } ?>
                      </div>


                      <div class="form-group">
                      <label>Product Image</label><br>
                      <div class="fg-upload-parent">
                      
                        <?php echo form_open_multipart('products/add_image',array('id'=>'form'));?>
                        <input type="hidden" value="<?php echo $pk_id; ?>" name="product_id">
                          <input id="up_file"  multiple="" type="file" name="up_file[]"  style="visibility:hidden; height:0px !important;" onchange="document.getElementById('import_file_text').value = this.value;">
                          <input  id="import_file_text" placeholder="" type="text" onclick="document.getElementById('up_file').click();" readonly>
                          <span class="fg-upload-btn " onclick="document.getElementById('up_file').click();">Choose</span>
                          <input id ="submit" type="submit"  value="Save Product" name="submit">
                        </form>
                      </div>
                      <p id ="iup_file" ></p>
                      <p id = "file_siez_text"></p>
                      <p id = "file_format_text"></p>
                      </div>





                  </a>
              </div>

      </div>

    </body>


</html>
<script>
function validation(){
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

        if(fileSize >500000){
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




    if (f == false||h==false|| i==false) {

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
