<html>
    <body>
        <div class="row col-md-6 col-md-offset-3 container">
                <div id="right-section-wrapper" class="panel panel-default">
                	<h2>Product Reviews</h2>
                    </div>
                   		 <div class="panel-body">           
                    

				                        <div class="form-group">
											<table border="1">
											<tr>
											<th>Review Id</th>
											<th>Review</th>
											<th>Rating</th>
											</tr>
											<?php foreach ($query as $reviewitem): ?>
												<tr>	
													<td><?php echo $reviewitem->pk_id;?></td>
													<td><?php echo $reviewitem->cust_review;?></td>
													<td><?php echo $reviewitem->rating;?></td>
												</tr>
												
											<?php endforeach; ?>
											</table>
											<?php
/*
<form action="" method='POST'>
<input type='hidden' name='productId' value='<?php echo $review_item['product_id'];?>'/>
<table>
<tbody>
<tr>
<th>Review</th>
<td><textarea name='review' rows='10' cols='50'></textarea></td>
</tr>
<tr>
<th>Rating</th>
<td><input type="text" name='rating' maxlength="3"/></td>
</tr>
<tr><td colspan='2'><input type='submit' value='Add Review'</td></tr>
</tbody>
</table>
</form>*/
?>

					</div>
				</div>
			</div>
		</body>
</html>