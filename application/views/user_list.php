<?php echo form_open('ban_user/update_ban_user'); ?>

	<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

		<tr>
				<th>No</th>
				<th>email</th>
				<th>Type</th>
		</tr>

		<?php $i = 1; ?>
		
		<?php foreach ($query as $row) : ?>

			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row->email; ?></td>
				<td>
					<!--?php echo form_dropdown('type_id', $type_list, set_value('type_id', $type_id));  ?-->
					
					<!--p>
					<select name="type">
						<option value="1">User</option>
						<option value="2">Banned User</option>
					</select>
					</p-->	
				</td>
				<td><button type="button" onclick=<?php //echo "change($id)"; ?>>Change Type</button></td>
			</tr>

		    <?php $i++; ?>

		<?php endforeach; ?>

	</table>
<?php echo form_submit('', 'Update user type'); ?>
<?php
/*<script>

  function change(id){
    $.ajax({
            type: "POST",
            url: "change_ban_user",
            dataType: 'json',
            data: {user_id: id}
        }).done(function(msg){
           window.location.reload();
        });
  }
</script>*/
?>