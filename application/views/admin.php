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
		<td><?php echo $review_item['pk_id'];?></td>
		<td><?php echo $review_item['cust_review'];?></td>
		<td><?php echo $review_item['rating'];?></td>
		<td><?php echo $review_item['product_id'];?></td>
		<td><?php echo $review_item['user_id'];?></td>
		<td><a href="<?php echo site_url('pages/deleteReview/'.$review_item['pk_id']);?>">Delete Review</a></td>
	</tr>
<?php endforeach; ?>
</table>
