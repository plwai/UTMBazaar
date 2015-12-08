<script type="text/javascript" src="<?php echo base_url(); ?>assets/rating/jquery-ui-1.8.12.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/rating/jquery.ui.stars.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/rating/jquery.ui.stars.min.css" />
<html>
    <body>
        <div class="row col-md-6 col-md-offset-3 container">
                <div id="right-section-wrapper" class="panel panel-default">
                    <div class="panel-heading" >
                        <h2>Tell us your Opinion</h2>
                    </div>
                    <div class="panel-body">           
                    

                        <div class="form-group">
                            
                            <textarea id= "cust_review" class="form-control" name="cust_review"  placeholder="Tell us what you thought about it" rows="6"></textarea>
                            
                        </div>
                        <div class="form-group" id="try"><?php echo $star; ?></div>
						<input type="hidden" id="product_id" name="product_id" value="5">
                        <?php echo validation_errors(); ?>
                        <p id ="respond_rating"></p>
                        <p id="respond_post"></p>
                        <p id="respond_review"></p>
                        <p id="respond_start"></p>
                        <div class="form-group">
                            <input id ="submit" type="submit"  value="Submit" name="submit">
                        </div>
                        
                                   
                    </div>
				</div>
        </div>

    </body>
</html>


<script>
            $(document).ready(function() {$state=false;
 $('#submit').click(function(){
    if($state==true){
        document.getElementById("respond_start").innerHTML=" ";
            $.ajax({
                type: "POST",
                url: "save_reviews",
                dataType: 'json',
                data: {mystart:$("input[name=mystar]").val(),cust_review:$("#cust_review").val(),product_id:$("#product_id").val()}   
                }).done(function(msg){
                    if(msg.res==1){
                        document.getElementById("respond_rating").innerHTML="done";

                    }
                    else{
                        document.getElementById("respond_rating").innerHTML="Review fail to add";
                    }if(msg.respost==0){
                        document.getElementById("respond_post").innerHTML="Posting error";
                    }
                    else{
                        document.getElementById("respond_post").innerHTML=" ";
                    }if(msg.resreview==0){
                        document.getElementById("respond_review").innerHTML="review cannot empty";
                    }else{
                        document.getElementById("respond_review").innerHTML="";
                    }
            
                });

    }else{
        document.getElementById("respond_start").innerHTML="Please rating first";
    }

 });
        });</script>
<script>
            $(document).ready(function() {
 $('#try').click(function(){
  
                        $state=true;

                   
            
             
 });
        });</script>