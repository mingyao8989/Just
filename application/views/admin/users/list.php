<?php 
$ext_param = my_ext_param($this->_segments, 3);

$this->session->set_userdata("backurl", current_url());
?>

<script type="text/javascript">
<!--
function delete_user(userid, username) {
	if (confirm("Are you sure delete '" + username + "'?")) {
		location.href="<?= site_url("admin/users/delete")?>/" + userid + "<?= $ext_param?>";
	}
}
//-->
</script>

<article class="module width_full">
	<header>
		<h3 class="tabs_involved">User List</h3>
		
		<div class="submit_link">
			<form action="<?= site_url('admin/users/search')?>" calss="formSearch" method="post">
				Actived: <select name="actived" onchange="this.form.submit();">
					<option value="">-- ALL -- </option>
					<option value="Y" <?php if ($actived=='Y') echo "selected"?>>Actived</option>
					<option value="N" <?php if ($actived=='N') echo "selected"?>>Blocked</option>
				</select>&nbsp;&nbsp;&nbsp;
				Search:<input type="text" name="text" value="<?= $text?>" style="width: 200px;"/>
				<input type="submit" value="Search" />&nbsp;
				<input type="button" value="New User" onclick="location.href='<?php echo site_url("admin/users/edit")?>'"/>&nbsp;
			</form>
		</div>
	</header>
	
	<table cellspacing="0" class="tablelist"> 
		<?php 
			$fileds = array();
 			$fileds[] = array('title'=>'', 'align'=>'left');
			$fileds[] = array('filed'=>'id', 'title'=>'ID', 'align'=>'left');
			$fileds[] = array('filed'=>'name', 'title'=>'User Name',);
			$fileds[] = array('filed'=>'email', 'title'=>'Email',);
			$fileds[] = array('filed'=>'phone', 'title'=>'Phone',);
			$fileds[] = array('filed'=>'joined', 'title'=>'When joined?', 'align'=>'left');
			$fileds[] = array('title'=>'Options');
			
			$this->load->view('admin/common/table_header', array('order'=>$order, 'fileds'=>$fileds));
		?>
		<tbody>
		<?php if($users->result_count() > 0): ?>
		<!-- show user list --> 
		<?php
			$base_url = current_url();
		
			$odd = FALSE;
			foreach($users as $u):
				$odd = !$odd;
		?>
			<tr class="<?php echo $odd ? 'odd' : 'even'; ?>">
				<td>
					<a href="<?= site_url("admin/users/edit/".$u->id)?>" title="Select this User">
						<img src="<?= $u->avatar; ?>" width="30">
					</a>
				</td>
				<td>
					<a href="<?= site_url("admin/users/edit/".$u->id)?>" title="Edit this User"><?= $u->id?></a>
				</td>
				<td>
					<a href="<?= site_url("admin/users/edit/".$u->id)?>" title="Edit this User"><?php echo htmlspecialchars($u->name); ?></a>
				</td>
				<td >
					<a href="mailto:<?php echo htmlspecialchars($u->email); ?>"><?php echo htmlspecialchars($u->email); ?></a>
				</td>
				<td>
					<?php echo htmlspecialchars($u->phone); ?>
				</td>
				<td>
					<?= $u->joined?>
				</td>
				<td>
					<a href="<?php echo site_url('admin/users/edit/' . $u->id); ?>" title="Edit this User"><?php echo my_icon('edit', 'Edit this User'); ?></a>
					&nbsp;
					<?php if ($u->actived == 'Y'):?>
						<a href="<?= site_url("admin/users/blocked/".$u->id.$ext_param)?>" title="Active this User"><?php echo my_icon('actived', 'Active this User'); ?></a>
					<?php else:?>
						<a href="<?= site_url("admin/users/actived/".$u->id.$ext_param)?>" title="Block this User"><?php echo my_icon('blocked', 'Block this User'); ?></a>
					<?php endif;?>
					&nbsp;
					<a href="javascript:delete_user(<?= $u->id?>, '<?= $u->username?>')" title="Delete this User"><?php echo my_icon('delete', 'Delete this User'); ?></a>
				</td>
			</tr>
		<?php
			endforeach;
		?>
		<?php else:?>
			<tr><td colspan="5">Emprty Users</td></tr>
		<?php endif;?>
		</tbody> 
	</table>
	
	<footer>
		<?php $this->load->view('admin/common/article_paging', array('model'=>'Device', 'paged'=>$users->paged)); ?>
	</footer>
</article>