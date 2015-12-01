<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <body>
        <div class="row col-md-6 col-md-offset-3 container">
                <div id="right-section-wrapper" class="panel panel-default">
                	<h2>Product Reviews</h2>
                    </div>
                   		 <div class="panel-body">           
                    

				                        <div class="form-group">
				                    <div class="panel-heading" ><table border="1">
									<tr>
									<th>Product Id</th>
									<th>Product Name</th>
									<th>Reviews</th>
									</tr>
									<?php foreach ($products as $product_item): ?>	
										<tr>	
											<td><?php echo $product_item['pk_id'];?></td>
											<td><?php echo $product_item['product_name'];?></td>
											 <div class="form-group">
									         	 <td><a href="<?php echo site_url('Pages/display_reviews/'.$product_item['pk_id']);?>">View Reviews</a></td>      
									          </div>
						
											</tr>
							 </div>
							 </div>
					<?php endforeach; ?>
							</table>
						</div>

				</div>
        </div>

    </body>
</html>

