<form action="?page=add-order-page" method="post">
	<table style="text-align:center;">
		<tr>
			<th>POST TYPES</th>
			<th>ADD ORDER FIELD</th>
		</tr>
			<?php
			foreach ($posts as $post) {
				if ($post !="attachment"){
					if(! in_array($post,$all_options)){?>
						<tr>
							<td><strong><?php echo strtoupper($post)?> :</strong></td>	
							<td><input type="checkbox" value="<?php echo $post?>" name="posts[]"></td>
						</tr>
			<?php  }else{ ?>
						<tr>
							<td><strong><?php echo strtoupper($post)?> :</strong></td>	
							<td>
								<input type="checkbox" value="<?php echo $post?>" name="posts[]" checked></td>
						</tr>
				<?php }
				}
			} 
			?>
		<tr>
			<td ><?=submit_button();?></td>
			<td>
				<label for="">Check all :</label>
				<input type="checkbox" id="select_all"></td>
		</tr>
	</table>
</form>