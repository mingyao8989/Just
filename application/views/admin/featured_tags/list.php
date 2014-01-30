<script type="text/javascript">
<!--
function delete_featured_tag(featured_tagid, featured_tagname) {
	if (confirm("Are you sure delete '" + featured_tagname + "'?")) {
		location.href="<?= site_url("admin/featured_tags/delete")?>/" + featured_tagid;
	}
}
//-->
</script>

<article class="module width_full">
	<header>
		<h3 class="tabs_involved">Tag List</h3>
		
		<div class="submit_link">
			<input type="button" value="New Tag" onclick="location.href='<?php echo site_url("admin/featured_tags/edit")?>'"/>&nbsp;
		</div>
	</header>
	
	<table cellspacing="0" class="tablelist tablesorter"> 
		<?php 
			$fileds = array();
 			$fileds[] = array('filed'=>'', 'title'=>'Created',);
			$fileds[] = array('filed'=>'', 'title'=>'Tag');
			$fileds[] = array('title'=>'Options');
			
			$this->load->view('admin/common/table_header', array('fileds'=>$fileds));
		?>
		<tbody>
		<?php if($featured_tags->result_count() > 0): ?>
		<!-- show featured_tag list --> 
		<?php
			$base_url = current_url();
		
			$odd = FALSE;
			foreach($featured_tags as $u):
				$odd = !$odd;
		?>
			<tr class="<?php echo $odd ? 'odd' : 'even'; ?>">
				<td>
					<?php echo $u->created?>
				</td>
				<td>
					<?php echo $u->name?>
				</td>
				<td>
					<a href="javascript:delete_featured_tag(<?= $u->id?>, '<?= $u->name?>')" title="Delete this Featured_tag"><?php echo my_icon('delete', 'Delete this Featured_tag'); ?></a>
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