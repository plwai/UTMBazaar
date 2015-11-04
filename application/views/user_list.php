

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
					
					<p>
					<select id=<?php echo $row->pk_id; ?> name="type">
						<option value="1" <?php if($row->user_type == '1'){echo("selected");}?>>User</option>
						<option value="2" <?php if($row->user_type == '2'){echo("selected");}?>>Banned User</option>
					</select>
					</p>
					
				</td>
				<td><button type="button" onclick="func(<?php echo $row->pk_id ?>)">Change Type</button></td>
			</tr>

		    <?php $i++; ?>

		<?php endforeach; ?>

	</table>


<script>
function func(id){

 
  var e = document.getElementById(id);
var strUser = e.options[e.selectedIndex].value;
alert(id);
alert(strUser);
		$.ajax({
				type: "POST",
				url: "change_ban_user",
				dataType: 'json',
				data: {user_id: id,option_value:strUser}
			}).done(function(msg){
			   window.location.reload();
        });
	
  }
</script>