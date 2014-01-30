<script type="text/javascript">
<!--
function delete_media(mediaid, medianame) {
	if (confirm("Are you sure delete '" + medianame + "'?")) {
		location.href="<?= site_url("admin/medias/delete")?>/" + mediaid + "<?= $ext_param?>";
	}
}
//-->
</script>

<article class="module width_full">
	<header>
		<h3 class="tabs_involved">Media List</h3>
		
		<div class="submit_link">
			<form action="<?= site_url('admin/medias/search')?>" calss="formSearch" method="post">
				Type: <select name="type" onchange="this.form.submit();">
					<option value="">-- ALL -- </option>
					<option value="photo" <?php if ($type=='photo') echo "selected"?>>Photo</option>
					<option value="audio" <?php if ($type=='audio') echo "selected"?>>Audio</option>
					<option value="video" <?php if ($type=='video') echo "selected"?>>Video</option>
				</select>&nbsp;&nbsp;&nbsp;
				Status: <select name="status" onchange="this.form.submit();">
					<option value="">-- ALL -- </option>
					<option value="live" <?php if ($status=='live') echo "selected"?>>Status</option>
					<option value="pending" <?php if ($type=='pending') echo "selected"?>>Pending</option>
				</select>&nbsp;&nbsp;&nbsp;
				UserID:<input type="text" name="user_id" value="<?= $user_id?>" style="width: 200px;"/>
				<input type="submit" value="Search" />&nbsp;
			</form>
		</div>
	</header>
	
	<table cellspacing="0" class="tablelist"> 
		<?php 
			$fileds = array();
 			$fileds[] = array('title'=>'', 'align'=>'left');
			$fileds[] = array('filed'=>'id', 'title'=>'ID',);
			$fileds[] = array('filed'=>'created', 'title'=>'Created',);
			$fileds[] = array('filed'=>'type', 'title'=>'Type',);
			$fileds[] = array('filed'=>'status', 'title'=>'Status',);
			$fileds[] = array('title'=>'Size',);
			$fileds[] = array('title'=>'Options');
			
			$this->load->view('admin/common/table_header', array('order'=>$order, 'fileds'=>$fileds));
		?>
		<tbody>
		<?php if($medias->result_count() > 0): ?>
		<!-- show media list --> 
		<?php
			$base_url = current_url();
		
			$odd = FALSE;
			foreach($medias as $u):
				$odd = !$odd;
		?>
			<tr class="<?php echo $odd ? 'odd' : 'even'; ?>">
				<td>
					<a href="<?= site_url("admin/medias/edit/".$u->id)?>" title="Select this Media">
						<img src="<?= $u->avatar; ?>" width="30">
					</a>
				</td>
				<td>
					<a href="<?= site_url("admin/medias/edit/".$u->id)?>" title="Edit this Media"><?= $u->id?></a>
				</td>
				<td>
					<a href="<?= site_url("admin/medias/edit/".$u->id)?>" title="Edit this Media"><?php echo htmlspecialchars($u->medianame); ?></a>
				</td>
				<td>
					<a href="<?= site_url("admin/medias/edit/".$u->id)?>" title="Edit this Media"><?php echo htmlspecialchars($u->name); ?></a>
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
					<a href="<?php echo site_url('admin/medias/edit/' . $u->id); ?>" title="Edit this Media"><?php echo my_icon('edit', 'Edit this Media'); ?></a>
					&nbsp;
					<?php if ($u->actived == 'Y'):?>
						<a href="<?= site_url("admin/medias/blocked/".$u->id.$ext_param)?>" title="Active this Media"><?php echo my_icon('actived', 'Active this Media'); ?></a>
					<?php else:?>
						<a href="<?= site_url("admin/medias/actived/".$u->id.$ext_param)?>" title="Block this Media"><?php echo my_icon('blocked', 'Block this Media'); ?></a>
					<?php endif;?>
					&nbsp;
					<a href="javascript:delete_media(<?= $u->id?>, '<?= $u->medianame?>')" title="Delete this Media"><?php echo my_icon('delete', 'Delete this Media'); ?></a>
				</td>
			</tr>
		<?php
			endforeach;
		?>
		<?php else:?>
			<tr><td colspan="5">Emprty Medias</td></tr>
		<?php endif;?>
		</tbody> 
	</table>
	
	<footer>
		<?php $this->load->view('admin/common/article_paging', array('model'=>'Media', 'paged'=>$medias->paged)); ?>
	</footer>
</article>