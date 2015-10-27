<body>
	<table cellpadding="6" cellspacing="1" border="1">

		<tr>
				<th>No</th>
				<th>email</th>
				<th>Type</th>
		</tr>

		<?php $i = 1; ?>
		<?php foreach ($query as $row) { ?>
			
			<!--?php echo form_hidden($i.'[rowid]', $rows['rowid']); ?-->

			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row->email; ?></td>
				<td>
					<?php echo form_dropdown('type_id', $type_list, set_value('type_id', $type_id));
					
					/*<p>
					<select name="type">
						<option value="1">User</option>
						<option value="2">Banned User</option>
					</select>
					</p>*/	
				</td>
			</tr>

		<?php $i++; ?>

		<?php endforeach; ?>

	</table>
</body>