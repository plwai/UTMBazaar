<html>
    <body>
        <div class="row col-md-6 col-md-offset-3 container">
                <div id="right-section-wrapper" class="panel panel-default">
                    <div class="panel-heading" >
                        <h2>Tell us your Opinion</h2>
                    </div>
                    <div class="panel-body">           
                        <?php echo form_open_multipart('reviews/save_reviews',array('id'=>'form'));?>

                        <div class="form-group">
                            
                            <textarea id= "cust_review" class="form-control" name="cust_review"  placeholder="Tell us what you thought about it" rows="6"></textarea>
                            
                        </div>
						<input type="hidden" name="product_id" value="1">
                        <?php echo $error;?>
                        <div class="form-group">
                            <input id ="submit" type="submit"  value="Submit" name="submit">
                        </div>
                        </form>
                                   
                    </div>
				</div>
        </div>

    </body>
</html>


