<script type="text/javascript">
<!--
function delete_featured_url(featured_urlid, featured_urlname) {
	if (confirm("Are you sure delete '" + featured_urlname + "'?")) {
		location.href="<?= site_url("admin/featured_urls/delete")?>/" + featured_urlid;
	}
}
//-->
</script>

<article class="module width_full">
	<header>
		<h3 class="tabs_involved">URL List</h3>
		
		<div class="submit_link">
			<input type="button" value="New URL" onclick="location.href='<?php echo site_url("admin/featured_urls/edit")?>'"/>&nbsp;
		</div>
	</header>
	
	<table cellspacing="0" class="tablelist tablesorter"> 
		<?php 
			$fileds = array();
 			$fileds[] = array('filed'=>'', 'title'=>'Created',);
			$fileds[] = array('filed'=>'', 'title'=>'URL');
			$fileds[] = array('title'=>'Options');
			
			$this->load->view('admin/common/table_header', array('fileds'=>$fileds));
		?>
		<tbody>
		<?php if($featured_urls->result_count() > 0): ?>
		<!-- show featured_url list --> 
		<?php
			$base_url = current_url();
		
			$odd = FALSE;
			foreach($featured_urls as $u):
				$odd = !$odd;
		?>
			<tr class="<?php echo $odd ? 'odd' : 'even'; ?>">
				<td>
					<?php echo $u->created?>
				</td>
				<td>
					<?php echo $u->url?>
				</td>
				<td>
					<a href="javascript:delete_featured_url(<?= $u->id?>, '<?= $u->url?>')" title="Delete this Featured_url"><?php echo my_icon('delete', 'Delete this Featured_url'); ?></a>
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