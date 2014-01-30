<article class="module width_full">
	<header>
		<h3 class="tabs_involved">Edit Options</h3>
		<div class="submit_link">
			<form action="<?= site_url('admin/devices/search')?>" calss="formSearch" method="post">
				Device OS: <select name="os" onchange="this.form.submit();">
					<option value="ios" <?php if ($os=='ios') echo "selected"?>>iOS</option>
					<option value="android" <?php if ($os=='android') echo "selected"?>>Android</option>
					<option value="brackbarry" <?php if ($os=='brackbarry') echo "selected"?>>BrackBarry</option>
					<option value="win" <?php if ($os=='win') echo "selected"?>>WinPhone</option>
				</select>
			</form>
		</div>
	</header>
	
	<table cellspacing="0" class="tablesorter"> 
		<thead> 
			<tr> 
   				<th class="header">Device</th>
			</tr> 
		</thead> 
		<tbody> 
		<?php
			$odd = FALSE;
			foreach($devices as $device):
				$odd = !$odd;
		?>
			<tr class="<?php echo $odd ? 'odd' : 'even'; ?>">
				<td>
					<?= $device->device?>
				</td>
			</tr>
		<?php
			endforeach;
		?>
		</tbody> 
	</table>
	
	<footer>
		<?php $this->load->view('admin/common/article_paging', array('model'=>'Device', 'paged'=>$devices->paged)); ?>
		
		<div class="submit_link">
			<form action="<?= site_url('admin/devices/search')?>" calss="formSearch" method="post">
				Device OS: <select name="os" onchange="this.form.submit();">
					<option value="ios" <?php if ($os=='ios') echo "selected"?>>iOS</option>
					<option value="android" <?php if ($os=='android') echo "selected"?>>Android</option>
					<option value="brackbarry" <?php if ($os=='brackbarry') echo "selected"?>>BrackBarry</option>
					<option value="win" <?php if ($os=='win') echo "selected"?>>WinPhone</option>
				</select>
			</form>
		</div>
	</footer>
</article>