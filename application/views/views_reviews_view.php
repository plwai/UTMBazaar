<html>
<style>
table { 
color: #333;
font-family: Helvetica, Arial, sans-serif;
width: 640px; 
border-collapse: 
collapse; border-spacing: 0; 
}

td, th { 
border: 1px solid transparent; /* No more visible border */
height: 30px; 
transition: all 0.3s;  /* Simple transition for hover effect */
}

th {
background: #DFDFDF;  /* Darken header a bit */
font-weight: bold;
}

td {
background: #FAFAFA;
text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */ 
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */ 
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; } /* Hover cell effect! */
</style>
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

