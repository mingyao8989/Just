<script type="text/javascript">
<!--
function delete_yoticon(yoticonid, yoticonname) {
	if (confirm("Are you sure delete '" + yoticonname + "'?")) {
		location.href="<?= site_url("admin/yoticons/delete")?>/" + yoticonid + "<?= $ext_param?>";
	}
}
//-->
</script>

<article class="module width_full">
	<header>
		<h3 class="tabs_involved">Yoticon List</h3>
		
		<div class="submit_link">
			
		</div>
	</header>
	
	<table cellspacing="0" class="tablelist tablesorter"> 
		<?php 
			$fileds = array();
 			$fileds[] = array('title'=>'', 'align'=>'left');
 			$fileds[] = array('title'=>'', 'align'=>'left');
			$fileds[] = array('filed'=>'', 'title'=>'Price',);
			$fileds[] = array('filed'=>'', 'title'=>'InApp',);
			$fileds[] = array('filed'=>'', 'title'=>'Name',);
			$fileds[] = array('title'=>'Options');
			
			$this->load->view('admin/common/table_header', array('fileds'=>$fileds));
		?>
		<tbody>
		<?php if($yoticons->result_count() > 0): ?>
		<!-- show yoticon list --> 
		<?php
			$base_url = current_url();
		
			$odd = FALSE;
			foreach($yoticons as $u):
				$odd = !$odd;
		?>
			<tr class="<?php echo $odd ? 'odd' : 'even'; ?>">
				<td>
					<a href="<?= site_url("admin/yoticons/edit/".$u->id)?>" title="Select this Yoticon">
						<img src="<?= $u->avatar; ?>" width="30">
					</a>
				</td>
				<td>
					<a href="<?= site_url("admin/yoticons/edit/".$u->id)?>" title="Edit this Yoticon"><?= $u->id?></a>
				</td>
				<td>
					<a href="<?= site_url("admin/yoticons/edit/".$u->id)?>" title="Edit this Yoticon"><?php echo htmlspecialchars($u->yoticonname); ?></a>
				</td>
				<td>
					<a href="<?= site_url("admin/yoticons/edit/".$u->id)?>" title="Edit this Yoticon"><?php echo htmlspecialchars($u->name); ?></a>
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
					<a href="<?php echo site_url('admin/yoticons/edit/' . $u->id); ?>" title="Edit this Yoticon"><?php echo my_icon('edit', 'Edit this Yoticon'); ?></a>
					&nbsp;
					<?php if ($u->actived == 'Y'):?>
						<a href="<?= site_url("admin/yoticons/blocked/".$u->id.$ext_param)?>" title="Active this Yoticon"><?php echo my_icon('actived', 'Active this Yoticon'); ?></a>
					<?php else:?>
						<a href="<?= site_url("admin/yoticons/actived/".$u->id.$ext_param)?>" title="Block this Yoticon"><?php echo my_icon('blocked', 'Block this Yoticon'); ?></a>
					<?php endif;?>
					&nbsp;
					<a href="javascript:delete_yoticon(<?= $u->id?>, '<?= $u->yoticonname?>')" title="Delete this Yoticon"><?php echo my_icon('delete', 'Delete this Yoticon'); ?></a>
				</td>
			</tr>
		<?php
			endforeach;
		?>
		<?php else:?>
			<tr><td colspan="5">Emprty Yoticons</td></tr>
		<?php endif;?>
		</tbody> 
	</table>
</article>