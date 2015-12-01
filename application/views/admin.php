
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">

    <body>
        <div class="row col-md-6 col-md-offset-3 container">
                <div id="right-section-wrapper" class="panel panel-default">
                	<h2>Admin Review</h2>
                    </div>
                   		 <div class="panel-body"> 
     <div class="form-group">
<table border="1">
<tr>
<th>Review Id</th>
<th>Review</th>
<th>Rating</th>
<th>Product Id</th>
<th>User Id</th>
<th>Delete</th>
</tr>
<?php foreach ($review as $review_item): ?>
	<tr>	
		<td><?php echo $review_item->pk_id;?></td>
		<td><?php echo $review_item->cust_review;?></td>
		<td><?php echo $review_item->rating;?></td>
		<td><?php echo $review_item->product_id;?></td>
		<td><?php echo $review_item->user_id;?></td>
		<div class="form-group">
			<td><a href="<?php echo site_url('pages/deleteReview/'.$review_item->pk_id);?>">Delete Review</a></td>
			</div>
	</tr>
<?php endforeach; ?>


</table>
<p><b><center><?php echo $links; ?></center></b></p>
</div>
</div>
</div>
</body>
</html>
