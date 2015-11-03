<table border="1">
<tr>
<th>Product Id</th>
<th>Product Name</th>
<th>Reviews</th>
</tr>
<?php foreach ($products as $product_item): ?>	
	<tr>	
		<td><?php echo $product_item['pk_id'];?></td>
		<td><?php echo $product_item['product_name'];?></td>
		<td><a href="<?php echo site_url('Pages/display_reviews/'.$product_item['pk_id']);?>">View Reviews</a></td>
	</tr>
<?php endforeach; ?>
</table>
