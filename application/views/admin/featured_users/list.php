<script type="text/javascript">
<!--
function delete_featured_user(featured_userid, featured_username) {
	if (confirm("Are you sure delete '" + featured_username + "'?")) {
		location.href="<?= site_url("admin/featured_users/delete")?>/" + featured_userid;
	}
}
//-->
</script>

<article class="module width_full">
	<header>
		<h3 class="tabs_involved">Featured User List</h3>
		
		<div class="submit_link">
			<input type="button" value="Add User" onclick="location.href='<?php echo site_url("admin/featured_users/edit")?>'"/>&nbsp;
		</div>
	</header>
	
	<table cellspacing="0" class="tablelist tablesorter"> 
		<?php 
			$fileds = array();
 			$fileds[] = array('filed'=>'', 'title'=>'Sort Num',);
			$fileds[] = array('filed'=>'', 'title'=>'User');
			$fileds[] = array('title'=>'Options');
			
			$this->load->view('admin/common/table_header', array('fileds'=>$fileds));
		?>
		<tbody>
		<?php if($featured_users->result_count() > 0): ?>
		<!-- show featured_user list --> 
		<?php
			$base_url = current_url();
		
			$odd = FALSE;
			foreach($featured_users as $u):
				$odd = !$odd;
				$user = $u->user->get();
		?>
			<tr class="<?php echo $odd ? 'odd' : 'even'; ?>">
				<td>
					<?php echo $u->sort_num?>
				</td>
				<td>
					<?php echo $user?>
				</td>
				<td>
					<a href="javascript:delete_featured_user(<?= $u->id?>, '<?= $user?>')" title="Delete this Featured_user"><?php echo my_icon('delete', 'Delete this Featured_user'); ?></a>
				</td>
			</tr>
		<?php
			endforeach;
		?>
		<?php else:?>
			<tr><td colspan="5">Emprty Contents</td></tr>
		<?php endif;?>
		</tbody> 
	</table>
</article>